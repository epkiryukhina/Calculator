<?php
namespace App\MathBundle\Tests;

use App\MathBundle\Service\MathService;
use PHPUnit\Framework\TestCase;

class MathServiceTest extends TestCase
{
    private $mathService;

    public function setUp()
    {
        $this->mathService = new MathService();
        parent::setUp();
    }

    public function additionData()
    {
        return [
            'Two wood' => [
                'first' => '0.124567708',
                'second' => '0.4233',
                'scale' => 9
            ],
            'Two wool' => [
                'first' => '124567708',
                'second' => '4233',
                'scale' => 0
            ],
            'Two wool and wood' => [
                'first' => '124567708',
                'second' => '0.4233',
                'scale' => 4
            ],
            'With zero' => [
                'first' => '745.124567708',
                'second' => '0',
                'scale' => 9
            ],
            'One with minus' => [
                'first' => '-745.124567708',
                'second' => '345.999',
                'scale' => 9
            ],
            'Two with minus' => [
                'first' => '-745.124567708',
                'second' => '-345.999',
                'scale' => 9
            ]
        ];
    }

    /**
     * @test
     * @dataProvider additionData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function addition(string $first, string $second, int $scale)
    {
        $result = $this->mathService->addition($first, $second);
        $this->assertEquals(bcadd($first, $second, $scale), $result);
    }

    public function substractionData()
    {
        return [
            'Two wood' => [
                'first' => '0.124567708',
                'second' => '0.4233',
                'scale' => 9
            ],
            'Two wool' => [
                'first' => '124567708',
                'second' => '4233',
                'scale' => 0
            ],
            'Two wool and wood' => [
                'first' => '124567708',
                'second' => '0.4233',
                'scale' => 4
            ],
            'With zero' => [
                'first' => '745.124567708',
                'second' => '0',
                'scale' => 9
            ],
            'Negative result' => [
                'first' => '7708',
                'second' => '423773',
                'scale' => 0
            ],
            'Zero result' => [
                'first' => '745.12',
                'second' => '745.12',
                'scale' => 0
            ]
        ];
    }

    /**
     * @test
     * @dataProvider substractionData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function subtraction(string $first, string $second, int $scale)
    {
        $result = $this->mathService->subtraction($first, $second);
        $this->assertEquals(bcsub($first, $second, $scale), $result);
    }

    public function multiplicationData()
    {
        return [
            'Two wood' => [
                'first' => '0.12',
                'second' => '0.12342',
                'scale' => 7
            ],
            'Two wool' => [
                'first' => '745',
                'second' => '734',
                'scale' => 0
            ],
            'Two wool and wood' => [
                'first' => '745',
                'second' => '0.12',
                'scale' => 1
            ],
            'With zero' => [
                'first' => '745.12',
                'second' => '0',
                'scale' => 0
            ],
            'One with minus' => [
                'first' => '-745.124567708',
                'second' => '345.999',
                'scale' => 12
            ],
            'Two with minus' => [
                'first' => '-745.124567708',
                'second' => '-345.999',
                'scale' => 12
            ]
        ];
    }

    /**
     * @test
     * @dataProvider multiplicationData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function multiplication(string $first, string $second, int $scale)
    {
        $result = $this->mathService->multiplication($first, $second);
        $this->assertEquals(bcmul($first, $second, $scale), $result);
    }
}
