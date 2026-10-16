package com.pharmacare.controller;

import com.pharmacare.dto.request.StockReceiptRequest;
import com.pharmacare.dto.response.FEFOBatchAllocationResponse;
import com.pharmacare.service.FEFOInventoryService;
import jakarta.validation.Valid;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/inventory")
public class InventoryController {
    private final FEFOInventoryService inventoryService;

    public InventoryController(FEFOInventoryService inventoryService) {
        this.inventoryService = inventoryService;
    }

    @GetMapping("/batches")
    @PreAuthorize("hasAnyRole('WAREHOUSE', 'PHARMACIST', 'ADMIN')")
    public List<FEFOBatchAllocationResponse> listBatches() {
        return inventoryService.listAllAvailableBatches();
    }

    @GetMapping("/medicines/{medicineId}/batches")
    @PreAuthorize("hasAnyRole('WAREHOUSE', 'PHARMACIST', 'ADMIN')")
    public List<FEFOBatchAllocationResponse> listMedicineBatches(@PathVariable Long medicineId) {
        return inventoryService.listAvailableBatches(medicineId);
    }

    @PostMapping("/receipts")
    @PreAuthorize("hasAnyRole('WAREHOUSE', 'ADMIN')")
    @ResponseStatus(HttpStatus.CREATED)
    public FEFOBatchAllocationResponse receive(@Valid @RequestBody StockReceiptRequest request) {
        return inventoryService.receive(request);
    }
}
