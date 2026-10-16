package com.pharmacare.entity;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Table;
import jakarta.persistence.UniqueConstraint;

@Entity
@Table(name = "order_allocations", uniqueConstraints = @UniqueConstraint(
        name = "uk_order_item_batch", columnNames = {"order_item_id", "batch_id"}))
public class OrderAllocation {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "order_item_id", nullable = false)
    private OrderItem orderItem;

    @ManyToOne(fetch = FetchType.LAZY, optional = false)
    @JoinColumn(name = "batch_id", nullable = false)
    private Batch batch;

    @Column(nullable = false)
    private int quantity;

    protected OrderAllocation() {
    }

    public OrderAllocation(Batch batch, int quantity) {
        this.batch = batch;
        this.quantity = quantity;
    }

    public void setOrderItem(OrderItem orderItem) { this.orderItem = orderItem; }
    public Long getBatchId() { return batch.getId(); }
    public String getBatchNumber() { return batch.getBatchNumber(); }
    public int getQuantity() { return quantity; }
}
