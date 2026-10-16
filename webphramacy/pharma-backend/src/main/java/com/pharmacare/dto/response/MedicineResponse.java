package com.pharmacare.dto.response;

import com.pharmacare.entity.Medicine;

import java.math.BigDecimal;

public record MedicineResponse(
        Long id,
        String name,
        String activeIngredient,
        String strength,
        String dosageForm,
        String unit,
        BigDecimal salePrice,
        String barcode,
        boolean requiresPrescription
) {
    public static MedicineResponse from(Medicine medicine) {
        return new MedicineResponse(medicine.getId(), medicine.getName(),
                medicine.getActiveIngredient(), medicine.getStrength(),
                medicine.getDosageForm(), medicine.getUnit(), medicine.getSalePrice(),
                medicine.getBarcode(), medicine.isRequiresPrescription());
    }
}
