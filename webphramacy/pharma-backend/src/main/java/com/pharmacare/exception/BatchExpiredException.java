package com.pharmacare.exception;

public class BatchExpiredException extends RuntimeException {
    public BatchExpiredException(String batchNumber) {
        super("Cannot receive or issue expired batch: " + batchNumber + ".");
    }
}
