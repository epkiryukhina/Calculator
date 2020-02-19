<?php
namespace App\MathBundle\Service;

interface MathServiceInterface
{
    /**
     * @param string $first
     * @param string $second
     */
    public function AdditionTwo(string $first, string $second);
    /**
     * @param string $first
     * @param string $second
     * @param string $third
     */
    public function AdditionThree(string $first, string $second, string $third);
    /**
     * @param string $first
     * @param string $second
     */
    public function Subtraction(string $first, string $second);
    /**
     * @param string $first
     * @param string $second
     */
    public function Multiplication(string $first, string $second);
}