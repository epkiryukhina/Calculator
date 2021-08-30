<?php
namespace App\MathBundle\Validator;

use App\MathBundle\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NumberValidator extends ConstraintValidator
{
//    public function validate($value, Constraint $constraint)
//    {
//        if ($value->get('first') != null
//            && $value->get('second') != null
//            && self::isNumber((string)$value->get('first'))
//            && self::isNumber((string)$value->get('second'))) {
//            return true;
//        }
//
//        throw new UnexpectedValueException();
//    }

    public function validate($value, Constraint $constraint)
    {
        preg_match("/^-{0,1}\d+(\.\d+){0,1}$/", $value, $strs);

        if (count($strs) != 0) {
            return;
        }

        throw new UnexpectedValueException();
    }
}