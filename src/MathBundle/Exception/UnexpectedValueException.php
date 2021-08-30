<?php
namespace App\MathBundle\Exception;

use Exception;

class UnexpectedValueException extends Exception
{
    protected $message = 'Value is not expected';
}