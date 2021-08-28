<?php
namespace App\MathBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class MathValidationService implements MathValidationServiceInterface
{
    protected function isNumber($str)
    {
        preg_match("/^-{0,1}\d+(\.\d+){0,1}$/", $str, $strs);

        if (count($strs) != 0) {
            return true;
        }

        return false;

    }

    /**
     * @param Request $request
     * @return bool
     */
    public function ValidateTwoNumber(Request $request): bool
    {
        if ($request->get('first') != null
            && $request->get('first') != null
            && self::isNumber((string)$request->get('first'))
            && self::isNumber((string)$request->get('second'))) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function ValidateThreeNumber(Request $request): bool
    {
        if ($request->get('first') != null
            && $request->get('first') != null
            && $request->get('third') != null
            && self::isNumber((string)$request->get('first'))
            && self::isNumber((string)$request->get('second'))
            && self::isNumber((string)$request->get('third'))) {
            return true;
        }

        return false;
    }
}