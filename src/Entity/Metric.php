<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Interfaces\MetricInterface;
use \DateTimeInterface;

/**
 * Metric class
 *
 * @package App\Entity
 */
class Metric implements MetricInterface
{
    /**
     * Id
     *
     * @var int
     */
    private $id;
    
    /**
     * Metric value
     *
     * @var float
     */
    private $metricValue;

    /**
     * Date of measurement
     *
     * @var \DateTimeInterface
     */
    private $dtime;

    /**
     * Set Id
     *
     * @param   int $id Id
     * @return Metric
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set metric data
     *
     * @param   float   $metric Metric data
     * @return Metric
     */
    public function setMetricValue($metric): self
    {
        $this->metricValue = $metric;
        return $this;
    }

    /**
     * Get metric data
     *
     * @return float
     */
    public function getMetricValue(): ?float
    {
        return $this->metricValue;
    }

    /**
     * Set date
     *
     * @param   DateTimeInterface   $dtime  Date
     * @return Metric
     */
    public function setDtime(DateTimeInterface $dtime): self
    {
        $this->dtime = $dtime;
        return $this;
    }

    /**
     * Get date
     *
     * @return DateTimeInterface
     */
    public function getDtime(): DateTimeInterface
    {
        return $this->dtime;
    }
}
