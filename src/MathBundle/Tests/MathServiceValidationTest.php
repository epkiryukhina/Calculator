<?php
namespace App\MathBundle\Tests;

use App\MathBundle\Exception\ValidationException;
use App\MathBundle\Service\MathService;
use App\MathBundle\Service\MathServiceValidationDecorator;
use PHPUnit\Framework\TestCase;

class MathServiceValidationTest extends TestCase
{
    private $mathValidator;

    public function setUp()
    {
        $mathService = $this->createMock(MathService::class);
        $mathService->method('addition')->willReturn('good');
        $mathService->method('subtraction')->willReturn('good');
        $mathService->method('multiplication')->willReturn('good');
        $this->mathValidator = new MathServiceValidationDecorator($mathService);
        parent::setUp();
    }

    public function validationTestsData()
    {
        return [
            'Wool' => [
                'first' => '1',
                'second' => '2',
                'expected' => 'good'
            ],
            'Wood' => [
                'first' => '1.1',
                'second' => '2.2',
                'expected' => 'good'
            ],
            'With comma' => [
                'first' => '1,1',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'With two dots' => [
                'first' => '1..1',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'With two dots and a digit between' => [
                'first' => '1.1.1',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'Without a digit at the beginning' => [
                'first' => '.1',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'Without a digit in the end' => [
                'first' => '1.',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'With letters' => [
                'first' => '1.ab',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
            'Only dot' => [
                'first' => '.',
                'second' => '2.2',
                null,
                ValidationException::class
            ],
        ];
    }

    /**
     * @test
     * @dataProvider validationTestsData
     * @param string $first
     * @param string $second
     * @param string $expected
     */
    public function additionTest(string $first, string $second, string $expected = null, $exception = null)
    {
        if ($exception !== null) {
            $this->expectException($exception);
        }

        $result = $this->mathValidator->addition($first, $second);
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @dataProvider validationTestsData
     * @param string $first
     * @param string $second
     * @param string $expected
     */
    public function subtractionTest(string $first, string $second, string $expected = null, $exception = null)
    {
        if ($exception !== null) {
            $this->expectException($exception);
        }

        $result = $this->mathValidator->subtraction($first, $second);
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @dataProvider validationTestsData
     * @param string $first
     * @param string $second
     * @param string $expected
     */
    public function multiplicationTest(string $first, string $second, string $expected = null, $exception = null)
    {
        if ($exception !== null) {
            $this->expectException($exception);
        }

        $result = $this->mathValidator->multiplication($first, $second);
        $this->assertEquals($expected, $result);
    }
}