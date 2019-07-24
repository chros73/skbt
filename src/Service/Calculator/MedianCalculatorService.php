<?php declare(strict_types=1);

namespace App\Service\Calculator;

use App\Service\Calculator\Interfaces\CalculatorServiceInterface;
use \InvalidArgumentException;

/**
 * Calculates median of collection of numbers
 *
 * @package App\Service\Calculator
 */
class MedianCalculatorService implements CalculatorServiceInterface
{
    /**
     * Calculates median of collection of numbers
     *
     * @param   array   $input  Array of data
     * @return float
     */
    public function calculate(array $input): float
    {
        if (empty($input)) {
            throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
        }

        // Sort the array values first
        sort($input);

        $count = count($input);
        $index = floor($count/2);
        $median = null;

        // Check whether the number of elements is odd or even
        if ($count & 1) {
            $median = $input[$index];
        } else {
            $median = ($input[$index-1] + $input[$index]) / 2;
        }

        return $median;
    }
}
