package com.pharmacare.repository;

import com.pharmacare.entity.Medicine;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface MedicineRepository extends JpaRepository<Medicine, Long> {
    Optional<Medicine> findByBarcodeAndActiveTrue(String barcode);
}
