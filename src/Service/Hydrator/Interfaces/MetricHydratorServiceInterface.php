<?php declare(strict_types=1);

namespace App\Service\Hydrator\Interfaces;

use App\Collection\MetricCollection;

/**
 * Metric Hydrator Service interface
 *
 * @package App\Service\Hydrator\Interfaces
 */
interface MetricHydratorServiceInterface
{
    /**
     * Hydrates metrics data into a collection of Metric objects
     *
     * @param   array   $input  Metrics data
     * @return MetricCollection
     */
    public function getMetrics(array $input): MetricCollection;
}
