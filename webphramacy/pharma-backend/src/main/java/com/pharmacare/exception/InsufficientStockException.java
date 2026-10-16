package com.pharmacare.exception;

public class InsufficientStockException extends RuntimeException {
    public InsufficientStockException(Long medicineId, int requested, int available) {
        super("Insufficient stock for medicine " + medicineId
                + ": requested " + requested + ", available " + available + ".");
    }
}
