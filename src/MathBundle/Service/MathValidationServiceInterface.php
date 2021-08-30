<?php
namespace App\MathBundle\Service;

use Symfony\Component\HttpFoundation\Request;

interface MathValidationServiceInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function validate(Request $request): bool;
}