<?php declare(strict_types=1);

namespace App\Service\Statistic;

use App\Collection\MetricCollection;
use App\Entity\Interfaces\MetricInterface;
use App\Service\Calculator\MedianCalculatorService;
use App\Service\Calculator\PerformanceCalculatorService;
use App\Service\Statistic\Interfaces\CalculateMetricStatisticServiceInterface;
use \InvalidArgumentException;

/**
 * Calculates metric statistics
 *
 * @package App\Service\Statistic
 */
class CalculateMetricStatisticService implements CalculateMetricStatisticServiceInterface
{
    /**
     * Divisor to calculate the result (Bytes to Megabits)
     *
     * @var float
     */
    const UNIT_DIVISOR = 8 / 1000 / 1000;

    /**
     * Divisor to calculate limit based on median value
     *
     * @var int
     */
    const LIMIT_DIVISOR = 2;

    /**
     * Calculates metric statistics, including avg, min, max, median
     * and under-performing intervals
     *
     * @param   MetricCollection    $metricCollection   Collection of metric data
     * @return array
     */
    public function calculate(MetricCollection $metricCollection): array
    {
        if (empty($metricCollection)) {
            throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
        }

        $metrics = $metricCollection->getArrayCopy();

        // Sort metrics by date
        usort($metrics, function (MetricInterface $a, MetricInterface $b) {
            return ($a->getDtime() == $b->getDtime() ? 0 : ($a->getDtime() < $b->getDtime() ? -1 : 1));
        });

        // Create multidimensional array from it
        $metricValues = array_map(function (MetricInterface $e) {
            return ['dtime' => $e->getDtime()->format('Y-m-d'), 'metricValue' => $e->getMetricValue()];
        }, $metrics);

        // Convert it to an associative array
        $metricsData = array_column($metricValues, 'metricValue', 'dtime');

        // Calculate the median of values
        $medianCalculatorService = new MedianCalculatorService();
        $median = $medianCalculatorService->calculate($metricsData);

        // Prepare statistics
        $statistics = [
            'from'  => array_key_first($metricsData),
            'to'    => array_key_last($metricsData),
            'avg'   => round(array_sum($metricsData) * self::UNIT_DIVISOR / count($metricValues), 2),
            'min'   => round(min($metricsData) * self::UNIT_DIVISOR, 2),
            'max'   => round(max($metricsData) * self::UNIT_DIVISOR, 2),
            'med'   => round($median * self::UNIT_DIVISOR, 2),
        ];

        // Get under-performing intervals if there is any
        $performanceCalculatorService = new PerformanceCalculatorService();
        $intervals = $performanceCalculatorService->calculatePerformance($metricsData, $median / self::LIMIT_DIVISOR);

        if (is_array($intervals) && !empty($intervals)) {
            $statistics['intervals'] = $intervals;
        }

        return $statistics;
    }
}
