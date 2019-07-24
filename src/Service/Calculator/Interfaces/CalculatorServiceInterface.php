<?php declare(strict_types=1);

namespace App\Service\Calculator\Interfaces;

/**
 * Calculator Service interface
 *
 * @package App\Service\Calculator\Interfaces
 */
interface CalculatorServiceInterface
{
    /**
     * Performs calculation on collection of numbers
     *
     * @param   array   $input  Array of data
     * @return float
     */
    public function calculate(array $input): float;
}
