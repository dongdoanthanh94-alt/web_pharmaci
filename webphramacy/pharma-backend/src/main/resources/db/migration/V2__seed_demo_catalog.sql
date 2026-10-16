INSERT INTO medicines
    (id, name, active_ingredient, strength, dosage_form, unit, sale_price, barcode, requires_prescription)
VALUES
    (1, 'Paracetamol 500mg', 'Paracetamol', '500mg', 'Viên nén', 'viên', 2500, '8935001234501', FALSE),
    (2, 'Vitamin C 1000mg', 'Ascorbic acid', '1000mg', 'Viên sủi', 'hộp', 45000, '8935001234502', FALSE),
    (3, 'Omeprazole 20mg', 'Omeprazole', '20mg', 'Viên nang', 'viên', 3200, '8935001234503', FALSE),
    (4, 'Nước muối sinh lý 0.9%', 'Sodium chloride', '0.9%', 'Dung dịch', 'chai', 12000, '8935001234504', FALSE),
    (5, 'Amoxicillin 500mg', 'Amoxicillin', '500mg', 'Viên nang', 'viên', 1800, '8935001234505', TRUE),
    (6, 'Oresol', 'Electrolytes', '27.9g', 'Bột pha uống', 'gói', 5000, '8935001234506', FALSE);

INSERT INTO batches (medicine_id, batch_number, expiry_date, quantity)
VALUES
    (1, 'PAR-2406-A', '2026-11-15', 84),
    (2, 'VIT-2501-C', '2027-07-19', 8),
    (3, 'OME-2502-A', '2027-08-28', 156),
    (4, 'NSO-2504-A', '2027-12-12', 320),
    (5, 'AMX-2408-B', '2027-03-02', 240),
    (6, 'ORS-2506-A', '2028-06-01', 92);

SELECT setval(pg_get_serial_sequence('medicines', 'id'), (SELECT MAX(id) FROM medicines));
