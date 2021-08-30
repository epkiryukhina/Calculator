<?php
namespace App\MathBundle\Service;

class MathService implements MathServiceInterface
{
    /**
     * @param string $first
     * @param string $second
     */
    //Вызов функций для сложения с учетом знака
    public function addition(string $first, string $second)
    {
        if ($first[0] == '-') {
            if ($second[0] == '-') {
                $result = "-" . self::additionTwoWithoutSign(substr($first, 1, strlen($first) - 1),
                        substr($second, 1, strlen($second) - 1));
            }
            else {
                $result = self::subtractionWithoutSign($second, substr($first, 1, strlen($first) - 1));
            }
        }
        else if ($second[0] == '-') {
            $result = self::subtractionWithoutSign($first, substr($second, 1, strlen($second) - 1));
        }
        else {
            $result = self::additionTwoWithoutSign($first, $second);
        }

        return $result;
    }

    /**
     * @param string $first
     * @param string $second
     */
    //Вызов функций для вычитания с учетом знака
    public function subtraction(string $first, string $second)
    {
        if ($first[0] == '-'){
            if ($second[0] == '-') {
                $result = self::subtractionWithoutSign(substr($second, 1, strlen($second) - 1),
                    substr($first, 1, strlen($first) - 1));
            }
            else {
                $result = "-" . self::additionTwoWithoutSign(substr($first, 1, strlen($first) - 1), $second);
            }
        }
        else if ($second[0] == '-') {
            $result = self::additionTwoWithoutSign($first, substr($second, 1, strlen($second) - 1));
        }
        else {
            $result = self::subtractionWithoutSign($first, $second);
        }

        return $result;
    }

    /**
     * @param string $first
     * @param string $second
     */
    //Умножение беззнаковых чисел
    public function multiplication(string $first, string $second)
    {
        list($first, $second, $sign) = self::getSignForMultiplication($first, $second);
        list($first, $second, $indentResult) = self::getWhole($first, $second);

        $length = strlen($second);
        $result = 0;
        $indent = 0;

        for ($i = $length - 1; $i > -1; $i--) {
            list($curResult, $indent) = self::multiplicationInt($first, $second[$i], $indent);
            $result = self::AdditionTwo($result, $curResult);
        }

        if ($indentResult != 0) {
            return $sign . substr($result, 0, strlen($result) - $indentResult)
                . '.' . substr($result, strlen($result) - $indentResult, strlen($result) - 1);
        }
        else {
            return $sign . $result;
        }
    }

    //Получение знака при умножении и множителей без знака
    protected function getSignForMultiplication($first, $second)
    {
        $sign = '';

        if ($first[0] == '-') {
            if ($second[0] == '-') {
                $first = substr($first, 1, strlen($first) - 1);
                $second = substr($second, 1, strlen($second) - 1);
            }
            else {
                $sign = '-';
                $first = substr($first, 1, strlen($first) - 1);
            }
        }
        else if ($second[0] == '-') {
            $sign = '-';
            $second = substr($second, 1, strlen($second) - 1);
        }

        return array($first, $second, $sign);
    }

    //Разделение чисел на целую и дробную часть и привидение строк к одному
    //размеру с помощью добавления не значащих 0
    protected function getWholeAndWood($first, $second)
    {
        if (strpos($first,'.')) {
            list($firstWhole, $firstWood) = explode('.', $first);
        }
        else {
            $firstWhole = $first;
            $firstWood = '';
        }

        if (strpos($second, '.')) {
            list($secondWhole, $secondWood) = explode('.', $second);
        }
        else{
            $secondWhole = $second;
            $secondWood = '';
        }

        $addLengthWhole = abs(strlen($secondWhole) - strlen($firstWhole));
        $addLengthWood = abs(strlen($secondWood) - strlen($firstWood));

        if (strlen($firstWhole) > strlen($secondWhole)) {
            for ($i = 0; $i < $addLengthWhole; $i++) {
                $secondWhole = '0' . $secondWhole;
            }
        }
        else {
            for ($i = 0; $i < $addLengthWhole; $i++) {
                $firstWhole = '0' . $firstWhole;
            }
        }

        if (strlen($firstWood) > strlen($secondWood)) {
            for ($i = 0; $i < $addLengthWood; $i++) {
                $secondWood = $secondWood . '0';
            }
        }
        else {
            for ($i = 0; $i < $addLengthWood; $i++) {
                $firstWood = $firstWood . '0';
            }
        }

        return array($firstWhole, $firstWood, $secondWhole, $secondWood);
    }

    //Сложение дробных беззнаковых чисел
    protected function additionTwoWithoutSign($first, $second)
    {
        list($firstWhole, $firstWood, $secondWhole, $secondWood) = self::getWholeAndWood($first, $second);

        list($resultWood, $residue) = self::additionInt($firstWood, $secondWood, 0);
        list($resultWhole, $residue) = self::additionInt($firstWhole, $secondWhole, $residue);

        if ($residue!=0) {
            $resultWhole = $residue . $resultWhole;
        }

        if ($resultWood == 0) {
            return $resultWhole;
        }
        else {
            return $resultWhole . '.' . $resultWood;
        }
    }

    //Сложение целых беззнаковых чисел
    protected function additionInt($first, $second, $residue)
    {
        $length = max(strlen($first), strlen($second));
        $result = "";

        for ($i = $length - 1; $i > -1; $i--) {
            $curSum = $first[$i] + $second[$i] + $residue;
            $result = ($curSum % 10).$result;
            $residue = intdiv($curSum, 10);
        }

        return array($result, $residue);
    }

    //Вычитание дробных беззнаковых чисел
    protected function subtractionWithoutSign($first, $second)
    {
        list($firstWhole, $firstWood, $secondWhole, $secondWood) = self::getWholeAndWood($first, $second);

        if ($firstWhole.'.'.$firstWood > $secondWhole.'.'.$secondWood) {
            $result = "";
            list($resultWood, $residue) = self::subtractionInt($firstWood, $secondWood, 0);
            list($resultWhole, $residue) = self::subtractionInt($firstWhole, $secondWhole, $residue);
        }
        else {
            $result = "-";
            list($resultWood, $residue) = self::subtractionInt($secondWood, $firstWood, 0);
            list($resultWhole, $residue) = self::subtractionInt($secondWhole, $firstWhole, $residue);
        }

        $result = $result.$resultWhole . '.' . $resultWood;

        return $result;
    }

    //Вычитание целых беззнаковых чисел
    protected function subtractionInt($first, $second, $residue)
    {
        $length = max(strlen($first), strlen($second));
        $result = "";

        for ($i = $length - 1; $i > -1; $i--) {
            $curFirst = (int)$first[$i];
            $curSecond = (int)$second[$i];

            if ($curFirst + $residue < $curSecond) {
                $result = ((10 + $curFirst + $residue - $curSecond) % 10) . $result;
                $residue = -1;
            }
            else {
                $result = (($curFirst + $residue - $curSecond) % 10) . $result;
                $residue = 0;
            }
        }

        return array($result, $residue);
    }

    //Получение целых чисел и сдвига
    protected function getWhole($first, $second)
    {
        $indentResult = 0;
        if ($firstPos = strpos($first, '.')) {
            $indentResult += strlen($first) - $firstPos - 1;
        }
        if ($secondPos = strpos($second, '.')) {
            $indentResult += strlen($second) - $secondPos - 1;
        }

        return array(str_replace('.', '', $first),
            str_replace('.','', $second), $indentResult);
    }

    //Умножение длинного целого числа на цифру с учетом сдвига
    protected function multiplicationInt($number, $digit, $indent)
    {
        $length = strlen($number);
        $result = "";
        $residue = 0;

        for ($i = $length - 1; $i > -1; $i--) {
            $curMultiplication = $number[$i]*$digit + $residue;
            $result = ($curMultiplication % 10).$result;
            $residue = intdiv($curMultiplication, 10);
        }

        if ($residue != 0) {
            $result = $residue . $result;
        }

        for ($i = 0; $i < $indent; $i++) {
            $result = $result . '0';
        }

        return array($result, $indent + 1);
    }
}