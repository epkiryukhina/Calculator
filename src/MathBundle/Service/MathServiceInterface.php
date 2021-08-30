<?php
namespace App\MathBundle\Service;

interface MathServiceInterface
{
    /**
     * @param string $first
     * @param string $second
     */
    public function addition(string $first, string $second);
    /**
     * @param string $first
     * @param string $second
     */
    public function subtraction(string $first, string $second);
    /**
     * @param string $first
     * @param string $second
     */
    public function multiplication(string $first, string $second);
}