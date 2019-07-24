<?php declare(strict_types=1);

namespace App\Entity\Interfaces;

use \DateTimeInterface;

/**
 * Metric interface
 *
 * @package App\Entity\Interfaces
 */
interface MetricInterface
{
    /**
     * Get Id
     *
     * @return int
     */
    public function getId(): ?int;

    /**
     * Get metric data
     *
     * @return float
     */
    public function getMetricValue(): ?float;

    /**
     * Get date
     *
     * @return DateTimeInterface
     */
    public function getDtime(): DateTimeInterface;
}
