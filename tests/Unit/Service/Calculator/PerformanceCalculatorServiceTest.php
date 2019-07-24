<?php declare(strict_types=1);

namespace App\Tests\Unit\Service\Calculator;

use App\Service\Calculator\PerformanceCalculatorService;
use PHPUnit\Framework\TestCase;
use \InvalidArgumentException;

/**
 * Class PerformanceCalculatorServiceTest
 *
 * @package App\Tests\Unit\Service\Calculator
 */
class PerformanceCalculatorServiceTest extends TestCase
{
    /**
     * Test constructor
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $calculator = new PerformanceCalculatorService();
        $this->assertInstanceOf('App\Service\Calculator\PerformanceCalculatorService', $calculator);
    }

    /**
     * Data provider for testCalculatePerformance() method
     *
     * @return array
     */
    public function calculatePerformanceProvider(): array
    {
        return array(
            array(
                'data'      => array('a' => 4, 'b' => 5, 'c' => 8, 'd' => 14),
                'limit'     => 6,
                'below'     => true,
                'expected'  => array(
                    array('from' => 'a', 'to' => 'b'),
                ),
            ),
            array(
                'data'      => array('a' => 4, 'b' => 5, 'c' => 8, 'd' => 14),
                'limit'     => 6,
                'below'     => false,
                'expected'  => array(
                    array('from' => 'c', 'to' => 'd'),
                ),
            ),
            array(
                'data'      => array('a' => 7, 'b' => 5, 'c' => 1, 'd' => 9, 'e' => 4, 'f' => 2, 'g' => 5, 'h' => 9, ),
                'limit'     => 6,
                'below'     => true,
                'expected'  => array(
                    array('from' => 'b', 'to' => 'c'),
                    array('from' => 'e', 'to' => 'g'),
                ),
            ),
            array(
                'data'      => array('a' => 7, 'b' => 5, 'c' => 1, 'd' => 9, 'e' => 4, 'f' => 2, 'g' => 5, 'h' => 9, ),
                'limit'     => 6,
                'below'     => false,
                'expected'  => array(
                    array('from' => 'a'),
                    array('from' => 'd'),
                    array('from' => 'h'),
                ),
            ),
            array(
                'data'      => array(),
                'limit'     => 0,
                'below'     => true,
                'expected'  => '',
            ),
        );
    }

    /**
     * Test calculate() method
     *
     * @dataProvider calculatePerformanceProvider
     * @param   array   $data       Input array
     * @param   float   $limit      Input data
     * @param   bool    $below      Input data
     * @param   array   $expected   Expected result
     * @return void
     */
    public function testCalculatePerformance($data, $limit, $below, $expected): void
    {
        $calculator = new PerformanceCalculatorService();

        if (!is_array($expected)) {
            $this->expectException(InvalidArgumentException::class);
        }

        $intervals = $calculator->calculatePerformance($data, $limit, $below);

        $this->assertEquals($expected, $intervals);
    }
}
