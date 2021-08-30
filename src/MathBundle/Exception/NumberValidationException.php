<?php
namespace App\MathBundle\Exception;

use Exception;
use Throwable;

class NumberValidationException extends Exception
{
    public function __construct(string $value)
    {
        parent::__construct('{{ $value }} is not a number.');
    }
}