<?php declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Metric;
use PHPUnit\Framework\TestCase;
use \DateTime;

/**
 * Class MetricTest
 *
 * @package App\Tests\Unit\Entity;
 */
class MetricTest extends TestCase
{
    public function testGettersSetters(): void
    {
        $metricValue = 12693166.98;
        $dtime = '2018-01-29';

        $metric = new Metric();
        $metric->setMetricValue($metricValue)
               ->setDtime((new DateTime($dtime)));

        $this->assertInstanceOf('App\Entity\Metric', $metric);
        $this->assertEquals($metricValue, $metric->getMetricValue());
        $this->assertEquals($dtime, $metric->getDtime()->format('Y-m-d'));
        $this->assertNull($metric->getId());
    }
}
