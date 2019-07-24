<?php declare(strict_types=1);

namespace App\Tests\Unit\Service\Calculator;

use App\Service\Calculator\MedianCalculatorService;
use PHPUnit\Framework\TestCase;
use \InvalidArgumentException;

/**
 * Class MedianCalculatorServiceTest
 *
 * @package App\Tests\Unit\Service\Calculator
 */
class MedianCalculatorServiceTest extends TestCase
{
    /**
     * Test constructor
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $calculator = new MedianCalculatorService();
        $this->assertInstanceOf('App\Service\Calculator\MedianCalculatorService', $calculator);
    }

    /**
     * Data provider for testCalculate() method
     *
     * @return array
     */
    public function calculateProvider(): array
    {
        return array(
            array(
                'data'      => array(8, 4, 5, 14),
                'expected'  => 6.5,
            ),
            array(
                'data'      => array(9, 4, 5),
                'expected'  => 5,
            ),
            array(
                'data'      => array(),
                'expected'  => '',
            ),
        );
    }

    /**
     * Test calculate() method
     *
     * @dataProvider calculateProvider
     * @param   array   $data       Input array
     * @param   float   $expected   Expected result
     * @return void
     */
    public function testCalculate($data, $expected): void
    {
        $calculator = new MedianCalculatorService();

        if (!is_numeric($expected)) {
            $this->expectException(InvalidArgumentException::class);
        }

        $median = $calculator->calculate($data);

        $this->assertEquals($expected, $median);
    }
}
