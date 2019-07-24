<?php declare(strict_types=1);

namespace App\Service\Statistic\Interfaces;

use App\Collection\MetricCollection;

/**
 * Calculate Metric Statistic Service interface
 *
 * @package App\Service\Statistic\Interfaces
 */
interface CalculateMetricStatisticServiceInterface
{
    /**
     * Calculates metric statistics
     *
     * @param   MetricCollection    $metricCollection   Collection of metric data
     * @return array
     */
    public function calculate(MetricCollection $metricCollection): array;
}
