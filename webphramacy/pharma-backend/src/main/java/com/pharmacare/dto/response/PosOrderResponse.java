package com.pharmacare.dto.response;

import com.pharmacare.service.PosOrderService;

import java.math.BigDecimal;
import java.time.Instant;
import java.util.List;

public record PosOrderResponse(
        Long orderId,
        String status,
        String paymentMethod,
        BigDecimal totalAmount,
        Instant createdAt,
        List<PosOrderService.ItemResult> items
) {
}
