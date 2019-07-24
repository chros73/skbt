<?php declare(strict_types=1);

namespace App\Service\Converter;

use App\Service\Converter\Interfaces\MetricJsonToArrayServiceInterface;
use \InvalidArgumentException;

/**
 * Converts metric JSON to array
 *
 * @package App\Service\Converter
 */
class MetricJsonToArrayService implements MetricJsonToArrayServiceInterface
{
    /**
     * Converts metric JSON to array
     *
     * @param   string  $input  JSON string
     * @return array
     */
    public function getMetrics($input): array
    {
        if (is_string($input) && !empty($input)) {
            $json = json_decode($input, true);

            if (json_last_error() === JSON_ERROR_NONE
                && isset($json['code'])
                && $json['code'] == "OK"
                && isset($json['data'])
                && !empty($json['data'])
                && isset($json['data'][0]['metricData'])
                && is_array($json['data'][0]['metricData'])) {
                return $json['data'][0]['metricData'];
            }
        }

        throw new InvalidArgumentException('Invalid argument was supplied to ' . get_class($this));
    }
}
