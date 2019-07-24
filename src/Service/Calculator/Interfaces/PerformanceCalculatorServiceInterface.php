<?php declare(strict_types=1);

namespace App\Service\Calculator\Interfaces;

/**
 * Performance Calculator Service interface
 *
 * @package App\Service\Calculator\Interfaces
 */
interface PerformanceCalculatorServiceInterface
{
    /**
     * Calculates performance on an array and selects
     * under/above-performing intervals based on the keys of arrray
     *
     * @param   array   $input  Array of values
     * @param   float   $limit  Performance limit
     * @param   bool    $below  Whether to calculate under- or above- performance
     * @return array
     */
    public function calculatePerformance(array $input, float $limit, bool $below = true): array;
}
