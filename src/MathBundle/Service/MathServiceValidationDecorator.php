<?php

namespace App\MathBundle\Service;

use App\MathBundle\Exception\ValidationException;
use App\MathBundle\Validator\Number;
use Symfony\Component\Validator\Validation;

class MathServiceValidationDecorator implements MathServiceInterface
{
    /** @var MathServiceInterface */
    private $mathService;

    public function __construct(
        MathServiceInterface $mathService
    ) {
        $this->mathService = $mathService;
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function addition(string $first, string $second)
    {
        $this->validate($first, $second);
        return $this->mathService->addition($first, $second);
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function subtraction(string $first, string $second)
    {
        $this->validate($first, $second);
        return $this->mathService->subtraction($first, $second);
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function multiplication(string $first, string $second)
    {
        $this->validate($first, $second);
        return $this->mathService->multiplication($first, $second);
    }

    private function validate(string $first, string $second)
    {
        $numberConstraint = new Number();
        $validator = Validation::createValidator();

        try {
            $validator->validate($first, $numberConstraint);
            $validator->validate($second, $numberConstraint);
            return true;
        }
        catch (\Exception $e) {
            throw new ValidationException('Invalid parameters for math operation', 400, $e);
        }
    }
}