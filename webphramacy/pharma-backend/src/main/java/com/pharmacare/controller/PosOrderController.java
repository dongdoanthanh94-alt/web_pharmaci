package com.pharmacare.controller;

import com.pharmacare.dto.request.PosOrderRequest;
import com.pharmacare.dto.response.PosOrderResponse;
import com.pharmacare.service.PosOrderService;
import jakarta.validation.Valid;
import org.springframework.http.HttpStatus;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api/pos/orders")
public class PosOrderController {
    private final PosOrderService posOrderService;

    public PosOrderController(PosOrderService posOrderService) {
        this.posOrderService = posOrderService;
    }

    @PostMapping
    @ResponseStatus(HttpStatus.CREATED)
    @PreAuthorize("hasAnyRole('PHARMACIST', 'ADMIN')")
    public PosOrderResponse create(@Valid @RequestBody PosOrderRequest request) {
        return posOrderService.placeOrder(request);
    }
}
