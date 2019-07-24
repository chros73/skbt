<?php declare(strict_types=1);

namespace App\Service\Hydrator;

use App\Collection\MetricCollection;
use App\Service\Hydrator\Interfaces\MetricHydratorServiceInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Hydrates metrics data into a collection of Metric objects
 *
 * @package App\Service\Hydrator
 */
class MetricHydratorService implements MetricHydratorServiceInterface
{
    /**
     * Hydrates metrics data into a collection of Metric objects
     *
     * @param   array   $input  Metrics data
     * @return MetricCollection
     */
    public function getMetrics(array $input): MetricCollection
    {
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer([new DateTimeNormalizer(), new ArrayDenormalizer(), $normalizer]);

        $metrics = $serializer->denormalize($input, 'App\Entity\Metric[]');

        return new MetricCollection($metrics);
    }
}
