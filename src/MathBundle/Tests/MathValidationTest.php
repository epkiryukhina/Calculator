<?php
namespace App\MathBundle\Tests;

use App\MathBundle\Service\MathValidationService;
use PHPUnit\Framework\TestCase;

class MathValidationTest extends TestCase
{
    private $mathValidationService;

    public function setUp()
    {
        $this->mathValidationService = new MathValidationService();
        parent::setUp();
    }

    public function MathValidationTestData()
    {
        return [
        ];
    }

    /**
     * @test
     * @dataProvider MathValidationTestData
     * @param string $first
     * @param string $second
     * @param bool $expected
     */
    public function MathValidationTest(string $first, string $second, bool $expected)
    {
//        $result = $this->mathValidationService->validate($first, $second);
//        $this->assertEquals($expected, $result);
    }
}