<?php declare(strict_types=1);

namespace App\Tests\Unit\Collection;

use App\Collection\MetricCollection;
use App\Entity\Metric;
use PHPUnit\Framework\TestCase;
use \DateTime;

/**
 * Class MetricCollectionTest
 *
 * @package App\Tests\Unit\Collection
 */
class MetricCollectionTest extends TestCase
{
    public function testMetricCollection(): void
    {
        $metricValue1 = 12693166.98;
        $dtime1 = '2018-01-29';

        $metricValue2 = 12753166.98;
        $dtime2 = '2018-02-03';

        $metric1 = new Metric();
        $metric1->setMetricValue($metricValue1)
                ->setDtime((new DateTime($dtime1)));

        $metric2 = new Metric();
        $metric2->setMetricValue($metricValue2)
                ->setDtime((new DateTime($dtime2)));

        $collection = new MetricCollection(array($metric1, $metric2));

        $this->assertInstanceOf('App\Entity\Metric', $metric1);
        $this->assertInstanceOf('App\Entity\Metric', $metric2);
        $this->assertInstanceOf('App\Collection\MetricCollection', $collection);

        $metrics = $collection->getArrayCopy();

        $this->assertEquals(array($metric1, $metric2), $metrics);
    }
}
