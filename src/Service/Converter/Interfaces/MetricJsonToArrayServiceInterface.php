<?php declare(strict_types=1);

namespace App\Service\Converter\Interfaces;

/**
 * Metric JSON to Array Service interface
 *
 * @package App\Service\Converter\Interfaces
 */
interface MetricJsonToArrayServiceInterface
{
    /**
     * Converts metric JSON to array
     *
     * @param   string  $input  JSON string
     * @return array
     */
    public function getMetrics($input): array;
}
