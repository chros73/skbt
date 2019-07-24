<?php declare(strict_types=1);

namespace App\Service\Calculator;

use App\Service\Calculator\Interfaces\PerformanceCalculatorServiceInterface;
use \InvalidArgumentException;

/**
 * Calculates performance of collection of numbers
 *
 * @package App\Service\Calculator
 */
class PerformanceCalculatorService implements PerformanceCalculatorServiceInterface
{
    /**
     * Calculates performance on a sorted array and selects
     * under/above-performing intervals based on the keys of arrray
     *
     * @param   array   $input  Sorted array of values
     * @param   float   $limit  Performance limit
     * @param   bool    $below  Whether to calculate under- or above- performance
     * @return array
     */
    public function calculatePerformance(array $input, float $limit, bool $below = true): array
    {
        if (empty($input)) {
            throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
        }

        // Compose multidimensional array of the affected intervals
        $intervals = [];
        $interval = [];

        foreach ($input as $key => $val) {
            if (($below && $val < $limit)
                || (!$below && $val > $limit)) {
                if (empty($interval)) {
                    $interval['from'] = $key;
                } else {
                    $interval['to'] = $key;
                }
            } else {
                if (!empty($interval)) {
                    $intervals[] = $interval;
                    $interval = [];
                }
            }
        }

        // Last interval has to be added as well
        if (!empty($interval)) {
            $intervals[] = $interval;
        }

        return $intervals;
    }
}
