package com.pharmacare.service;

import com.pharmacare.dto.request.StockReceiptRequest;
import com.pharmacare.dto.response.FEFOBatchAllocationResponse;
import com.pharmacare.entity.Batch;
import com.pharmacare.entity.InventoryTransaction;
import com.pharmacare.exception.BatchExpiredException;
import com.pharmacare.repository.BatchRepository;
import com.pharmacare.repository.InventoryTransactionRepository;
import com.pharmacare.repository.MedicineRepository;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;

import java.time.LocalDate;
import java.util.List;

@Service
public class FEFOInventoryService {
    private final BatchRepository batchRepository;
    private final MedicineRepository medicineRepository;
    private final InventoryTransactionRepository transactionRepository;

    public FEFOInventoryService(BatchRepository batchRepository, MedicineRepository medicineRepository,
                                InventoryTransactionRepository transactionRepository) {
        this.batchRepository = batchRepository;
        this.medicineRepository = medicineRepository;
        this.transactionRepository = transactionRepository;
    }

    @Transactional(readOnly = true)
    public List<FEFOBatchAllocationResponse> listAvailableBatches(Long medicineId) {
        return batchRepository.findAvailableBatchesFefo(medicineId, LocalDate.now()).stream()
                .map(batch -> new FEFOBatchAllocationResponse(
                        batch.getId(), batch.getMedicine().getId(), batch.getMedicine().getName(),
                        batch.getBatchNumber(), batch.getExpiryDate(), batch.getQuantity()))
                .toList();
    }

    @Transactional(readOnly = true)
    public List<FEFOBatchAllocationResponse> listAllAvailableBatches() {
        return batchRepository.findAllAvailableFefo(LocalDate.now()).stream()
                .map(batch -> new FEFOBatchAllocationResponse(
                        batch.getId(), batch.getMedicine().getId(), batch.getMedicine().getName(),
                        batch.getBatchNumber(), batch.getExpiryDate(), batch.getQuantity()))
                .toList();
    }

    @Transactional
    public FEFOBatchAllocationResponse receive(StockReceiptRequest request) {
        if (!request.expiryDate().isAfter(LocalDate.now())) {
            throw new BatchExpiredException(request.batchNumber());
        }
        var medicine = medicineRepository.findById(request.medicineId())
                .filter(found -> found.isActive())
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Active medicine not found."));

        Batch batch = batchRepository.save(new Batch(medicine, request.batchNumber(),
                request.expiryDate(), request.quantity()));
        transactionRepository.save(new InventoryTransaction(batch, request.quantity(), "RECEIPT"));
        return new FEFOBatchAllocationResponse(batch.getId(), medicine.getId(), medicine.getName(),
                batch.getBatchNumber(), batch.getExpiryDate(), batch.getQuantity());
    }
}
