package com.pharmacare.service;

import com.pharmacare.dto.response.MedicineResponse;
import com.pharmacare.repository.MedicineRepository;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

@Service
public class MedicineService {
    private final MedicineRepository medicineRepository;

    public MedicineService(MedicineRepository medicineRepository) {
        this.medicineRepository = medicineRepository;
    }

    public MedicineResponse findByBarcode(String barcode) {
        return medicineRepository.findByBarcodeAndActiveTrue(barcode)
                .map(MedicineResponse::from)
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Medicine barcode not found."));
    }
}
