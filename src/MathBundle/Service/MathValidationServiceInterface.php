<?php
namespace App\MathBundle\Service;

use Symfony\Component\HttpFoundation\Request;

interface MathValidationServiceInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function ValidateTwoNumber(Request $request): bool;
    /**
     * @param Request $request
     * @return bool
     */
    public function ValidateThreeNumber(Request $request): bool;
}