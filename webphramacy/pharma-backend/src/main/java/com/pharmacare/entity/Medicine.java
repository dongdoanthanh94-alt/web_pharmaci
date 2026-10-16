package com.pharmacare.entity;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

import java.math.BigDecimal;

@Entity
@Table(name = "medicines")
public class Medicine {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false, length = 200)
    private String name;

    @Column(name = "active_ingredient", nullable = false, length = 200)
    private String activeIngredient;

    @Column(nullable = false, length = 100)
    private String strength;

    @Column(name = "dosage_form", length = 100)
    private String dosageForm;

    @Column(nullable = false, length = 40)
    private String unit;

    @Column(name = "sale_price", nullable = false, precision = 12, scale = 2)
    private BigDecimal salePrice;

    @Column(nullable = false, unique = true, length = 100)
    private String barcode;

    @Column(name = "requires_prescription", nullable = false)
    private boolean requiresPrescription;

    @Column(name = "is_active", nullable = false)
    private boolean active = true;

    protected Medicine() {
    }

    public Long getId() { return id; }
    public String getName() { return name; }
    public String getActiveIngredient() { return activeIngredient; }
    public String getStrength() { return strength; }
    public String getDosageForm() { return dosageForm; }
    public String getUnit() { return unit; }
    public BigDecimal getSalePrice() { return salePrice; }
    public String getBarcode() { return barcode; }
    public boolean isRequiresPrescription() { return requiresPrescription; }
    public boolean isActive() { return active; }
}
