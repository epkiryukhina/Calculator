<?php
namespace App\MathBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Number extends Constraint
{
    public $message = 'The string is not a number';
}