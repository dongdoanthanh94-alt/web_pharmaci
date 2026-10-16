package com.pharmacare.dto.response;

import java.time.LocalDate;

public record FEFOBatchAllocationResponse(
        Long batchId,
        Long medicineId,
        String medicineName,
        String batchNumber,
        LocalDate expiryDate,
        int availableQuantity
) {
}
