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

    public function AdditionTwoData()
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
     * @dataProvider AdditionTwoData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function AdditionTwo(string $first, string $second, int $scale)
    {
        $result = $this->mathService->AdditionTwo($first, $second);
        $this->assertEquals(bcadd($first, $second, $scale), $result);
    }

    public function SubstractionData()
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
     * @dataProvider SubstractionData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function Subtraction(string $first, string $second, int $scale)
    {
        $result = $this->mathService->Subtraction($first, $second);
        $this->assertEquals(bcsub($first, $second, $scale), $result);
    }

    public function MultiplicationData()
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
                'scale' => 2
            ],
            'With zero' => [
                'first' => '745.12',
                'second' => '0',
                'scale' => 2
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
     * @dataProvider MultiplicationData
     * @param string $first
     * @param string $second
     * @param int $scale
     */
    public function Multiplication(string $first, string $second, int $scale)
    {
        $result = $this->mathService->Multiplication($first, $second);
        $this->assertEquals(bcmul($first, $second, $scale), $result);
    }
}
