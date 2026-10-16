package com.pharmacare.dto.request;

import jakarta.validation.constraints.Future;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Positive;

import java.time.LocalDate;

public record StockReceiptRequest(
        @NotNull Long medicineId,
        @NotBlank String batchNumber,
        @NotNull @Future LocalDate expiryDate,
        @Positive int quantity
) {
}
