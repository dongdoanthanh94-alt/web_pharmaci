package com.pharmacare.service;

import com.pharmacare.dto.request.PosOrderRequest;
import com.pharmacare.dto.response.PosOrderResponse;
import com.pharmacare.entity.InventoryTransaction;
import com.pharmacare.entity.Order;
import com.pharmacare.entity.OrderAllocation;
import com.pharmacare.entity.OrderItem;
import com.pharmacare.exception.InsufficientStockException;
import com.pharmacare.repository.BatchRepository;
import com.pharmacare.repository.InventoryTransactionRepository;
import com.pharmacare.repository.MedicineRepository;
import com.pharmacare.repository.OrderRepository;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

@Service
public class PosOrderService {
    private final BatchRepository batchRepository;
    private final InventoryTransactionRepository transactionRepository;
    private final MedicineRepository medicineRepository;
    private final OrderRepository orderRepository;

    public PosOrderService(BatchRepository batchRepository,
                           InventoryTransactionRepository transactionRepository,
                           MedicineRepository medicineRepository,
                           OrderRepository orderRepository) {
        this.batchRepository = batchRepository;
        this.transactionRepository = transactionRepository;
        this.medicineRepository = medicineRepository;
        this.orderRepository = orderRepository;
    }

    @Transactional
    public PosOrderResponse placeOrder(PosOrderRequest request) {
        Order order = new Order(request.customerName(), request.paymentMethod());
        BigDecimal subtotal = BigDecimal.ZERO;
        List<ItemResult> results = new ArrayList<>();

        for (PosOrderRequest.Item requestedItem : request.items()) {
            var medicine = medicineRepository.findById(requestedItem.medicineId())
                    .filter(found -> found.isActive())
                    .orElseThrow(() -> new ResponseStatusException(
                            HttpStatus.NOT_FOUND, "Active medicine " + requestedItem.medicineId() + " not found."));
            if (medicine.isRequiresPrescription()) {
                throw new ResponseStatusException(HttpStatus.UNPROCESSABLE_ENTITY,
                        "A valid prescription must be approved before selling " + medicine.getName() + ".");
            }

            OrderItem item = new OrderItem(medicine, requestedItem.quantity(), medicine.getSalePrice());
            order.addItem(item);
            List<BatchAllocation> allocations = allocateFefo(medicine.getId(), requestedItem.quantity(), item);
            subtotal = subtotal.add(medicine.getSalePrice()
                    .multiply(BigDecimal.valueOf(requestedItem.quantity())));
            results.add(new ItemResult(medicine.getId(), medicine.getName(), requestedItem.quantity(),
                    medicine.getSalePrice(), List.copyOf(allocations)));
        }

        if (request.discountAmount().compareTo(subtotal) > 0) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST,
                    "Discount cannot exceed the order subtotal.");
        }

        order.setDiscountAmount(request.discountAmount());
        order.setTotalAmount(subtotal.subtract(request.discountAmount()));
        Order savedOrder = orderRepository.save(order);
        return new PosOrderResponse(savedOrder.getId(), savedOrder.getStatus(),
                savedOrder.getPaymentMethod(), savedOrder.getTotalAmount(),
                savedOrder.getCreatedAt(), List.copyOf(results));
    }

    private List<BatchAllocation> allocateFefo(Long medicineId, int requestedQuantity, OrderItem item) {
        List<BatchAllocation> allocations = new ArrayList<>();
        int remaining = requestedQuantity;
        LocalDate today = LocalDate.now();

        for (var candidate : batchRepository.findAvailableBatchesFefo(medicineId, today)) {
            if (remaining == 0) break;
            var batch = batchRepository.findByIdForUpdate(candidate.getId())
                    .orElseThrow(() -> new IllegalStateException(
                            "An inventory batch disappeared during order allocation."));
            if (batch.getExpiryDate().isBefore(today) || batch.getQuantity() == 0) continue;

            int issued = Math.min(batch.getQuantity(), remaining);
            batch.decreaseQuantity(issued);
            transactionRepository.save(new InventoryTransaction(batch, -issued, "SALE"));
            item.addAllocation(new OrderAllocation(batch, issued));
            allocations.add(new BatchAllocation(batch.getId(), batch.getBatchNumber(),
                    batch.getExpiryDate(), issued));
            remaining -= issued;
        }

        if (remaining > 0) {
            throw new InsufficientStockException(medicineId, requestedQuantity, requestedQuantity - remaining);
        }
        return allocations;
    }

    public record BatchAllocation(Long batchId, String batchNumber, LocalDate expiryDate, int quantity) {
    }

    public record ItemResult(Long medicineId, String medicineName, int quantity,
                             BigDecimal unitPrice, List<BatchAllocation> allocations) {
    }
}
