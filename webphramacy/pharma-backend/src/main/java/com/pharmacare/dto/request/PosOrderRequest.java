package com.pharmacare.dto.request;

import jakarta.validation.Valid;
import jakarta.validation.constraints.DecimalMin;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotEmpty;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Pattern;
import jakarta.validation.constraints.Positive;
import jakarta.validation.constraints.Size;

import java.math.BigDecimal;
import java.util.List;

public record PosOrderRequest(
        @Size(max = 150) String customerName,
        @NotBlank @Pattern(regexp = "CASH|BANK_TRANSFER") String paymentMethod,
        @NotEmpty List<@Valid Item> items,
        @NotNull @DecimalMin("0.00") BigDecimal discountAmount
) {
    public record Item(@NotNull Long medicineId, @Positive int quantity) {
    }
}
