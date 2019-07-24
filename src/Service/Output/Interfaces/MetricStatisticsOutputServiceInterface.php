<?php declare(strict_types=1);

namespace App\Service\Output\Interfaces;

/**
 * Metric Statistics Output Service interface
 *
 * @package App\Service\Output\Interfaces
 */
interface MetricStatisticsOutputServiceInterface
{
    /**
     * Display and format statistics
     *
     * @param   array   $input  Statistics data
     * @return void
     */
    public function print(array $input): void;
}
