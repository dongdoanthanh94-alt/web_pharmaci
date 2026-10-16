package com.pharmacare.repository;

import com.pharmacare.entity.Batch;
import jakarta.persistence.LockModeType;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Lock;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.util.List;
import java.util.Optional;

public interface BatchRepository extends JpaRepository<Batch, Long> {
    @Query("""
            select b from Batch b
            join fetch b.medicine m
            where m.id = :medicineId and b.quantity > 0 and b.expiryDate >= :today
            order by b.expiryDate asc, b.id asc
            """)
    List<Batch> findAvailableBatchesFefo(@Param("medicineId") Long medicineId,
                                         @Param("today") LocalDate today);

    @Lock(LockModeType.PESSIMISTIC_WRITE)
    @Query("""
            select b from Batch b
            join fetch b.medicine m
            where b.id = :id
            """)
    Optional<Batch> findByIdForUpdate(@Param("id") Long id);

    @Query("""
            select b from Batch b
            join fetch b.medicine m
            where b.quantity > 0 and b.expiryDate >= :today
            order by b.expiryDate asc, b.id asc
            """)
    List<Batch> findAllAvailableFefo(@Param("today") LocalDate today);
}
