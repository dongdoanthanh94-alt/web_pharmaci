package com.pharmacare.dto.request;

import jakarta.validation.constraints.NotBlank;

public record BarcodeScanRequest(@NotBlank String barcode) {
}
