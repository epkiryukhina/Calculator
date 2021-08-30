<?php
namespace App\MathBundle\Validator;

use App\MathBundle\Exception\NumberValidationException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        preg_match("/^-{0,1}\d+(\.\d+){0,1}$/", $value, $strs);

        if (count($strs) !== 0) {
            return;
        }

        throw new NumberValidationException($value);
    }
}