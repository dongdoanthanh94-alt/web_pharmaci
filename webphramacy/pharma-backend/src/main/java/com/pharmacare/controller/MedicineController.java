package com.pharmacare.controller;

import com.pharmacare.dto.request.BarcodeScanRequest;
import com.pharmacare.dto.response.MedicineResponse;
import com.pharmacare.service.MedicineService;
import jakarta.validation.Valid;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api/medicines")
public class MedicineController {
    private final MedicineService medicineService;

    public MedicineController(MedicineService medicineService) {
        this.medicineService = medicineService;
    }

    @GetMapping("/barcode/{barcode}")
    public MedicineResponse findByBarcode(@PathVariable String barcode) {
        return medicineService.findByBarcode(barcode);
    }

    @PostMapping("/barcode/scan")
    public MedicineResponse scanBarcode(@Valid @RequestBody BarcodeScanRequest request) {
        return medicineService.findByBarcode(request.barcode());
    }
}
