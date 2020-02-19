<?php
namespace App\MathBundle\Tests;

use App\MathBundle\Service\MathService;
use PHPUnit\Framework\TestCase;

class MathUnitTestsTest extends TestCase
{
    private $mathService;

    public function setUp()
    {
        $this->mathService = new MathService();
        parent::setUp();
    }

    /** @test */
    public function AdditionTwoWood()
    {
        $result = $this->mathService->AdditionTwo('0.124567708','0.4233');
        $this->assertEquals(0.124567708+0.4233, $result);
    }

    /** @test */
    public function AdditionTwoWhole()
    {
        $result = $this->mathService->AdditionTwo('124567708','4233');
        $this->assertEquals(124567708+4233, $result);
    }

    /** @test */
    public function AdditionTwoWholeAndWood()
    {
        $result = $this->mathService->AdditionTwo('124567708','0.4233');
        $this->assertEquals(124567708+0.4233, $result);
    }

    /** @test */
    public function AdditionWithZero()
    {
        $result = $this->mathService->AdditionTwo('745.124567708','0');
        $this->assertEquals(745.124567708+0, $result);
    }

    /** @test */
    public function AdditionOneWithMinus()
    {
        $result = $this->mathService->AdditionTwo('-745.124567708','345.999');
        $this->assertEquals(-745.124567708+345.999, $result);
    }

    /** @test */
    public function AdditionTwoWithMinus()
    {
        $result = $this->mathService->AdditionTwo('-745.124567708','-345.999');
        $this->assertEquals(-745.124567708+(-345.999), $result);
    }

    /** @test */
    public function AdditionThree()
    {
        $result = $this->mathService->AdditionThree('745.1208','314.101','22344');
        $this->assertEquals(745.1208+314.101+22344, $result);
    }

    /** @test */
    public function SubtractionWood()
    {
        $result = $this->mathService->Subtraction('0.724567708','0.4233');
        $this->assertEquals(0.724567708-0.4233, $result);
    }

    /** @test */
    public function SubtractionWhole()
    {
        $result = $this->mathService->Subtraction('124567708','4233');
        $this->assertEquals(124567708-4233, $result);
    }

    /** @test */
    public function SubtractionWholeAndWood()
    {
        $result = $this->mathService->Subtraction('124567708','0.4233');
        $this->assertEquals(124567708-0.4233, $result);
    }

    /** @test */
    public function SubtractionZero()
    {
        $result = $this->mathService->Subtraction('745.124567708','0');
        $this->assertEquals(745.124567708-0, $result);
    }

    /** @test */
    public function SubtractionNegativeResult()
    {
        $result = $this->mathService->Subtraction('7708','423773');
        $this->assertEquals(7708-423773, $result);
    }

    /** @test */
    public function SubtractionZeroResult()
    {
        $result = $this->mathService->Subtraction('745.12','745.12');
        $this->assertEquals(745.12-745.12, $result);
    }

    /** @test */
    public function MultiplicationWhole()
    {
        $result = $this->mathService->Multiplication('745','734');
        $this->assertEquals(745*734, $result);
    }

    /** @test */
    public function SubtractionOneWithMinus()
    {
        $result = $this->mathService->Subtraction('-745.124567708','345.999');
        $this->assertEquals(-745.124567708-345.999, $result);
    }

    /** @test */
    public function SubtractionTwoWithMinus()
    {
        $result = $this->mathService->Subtraction('-745.124567708','-345.999');
        $this->assertEquals(-745.124567708-(-345.999), $result);
    }

    /** @test */
    public function MultiplicationWood()
    {
        $result = $this->mathService->Multiplication('0.12','0.12342');
        $this->assertEquals(0.12*0.12342, $result);
    }

    /** @test */
    public function MultiplicationWholeAndWood()
    {
        $result = $this->mathService->Multiplication('745','0.12');
        $this->assertEquals(745*0.12, $result);
    }

    /** @test */
    public function MultiplicationWithZero()
    {
        $result = $this->mathService->Multiplication('745.12','0');
        $this->assertEquals(745.12*0, $result);
    }

    /** @test */
    public function MultiplicationOneWithMinus()
    {
        $result = $this->mathService->Multiplication('-745.124567708','345.999');
        $this->assertEquals(-745.124567708*345.999, $result);
    }

    /** @test */
    public function MultiplicationTwoWithMinus()
    {
        $result = $this->mathService->Multiplication('745.124567708','345.999');
        $this->assertEquals(-745.124567708*(-345.999), $result);
    }
}
