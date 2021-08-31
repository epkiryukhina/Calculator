<?php
namespace App\MathBundle\Service;

class MathService implements MathServiceInterface
{
    /**
     * @param string $first
     * @param string $second
     */
    public function addition(string $first, string $second)
    {
        if ($first[0] === '-') {
            if ($second[0] === '-') {
                $result = "-" . $this->additionWithoutSign(
                    substr($first, 1),
                    substr($second, 1)
                );
            }
            else {
                $result = $this->subtractionWithoutSign(
                    $second,
                    substr($first, 1)
                );
            }
        }
        else if ($second[0] === '-') {
            $result = $this->subtractionWithoutSign(
                $first,
                substr($second, 1)
            );
        }
        else {
            $result = $this->additionWithoutSign(
                $first,
                $second
            );
        }

        return $result;
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function subtraction(string $first, string $second)
    {
        if ($first[0] === '-') {
            if ($second[0] === '-') {
                $result = $this->subtractionWithoutSign(
                    substr($second, 1),
                    substr($first, 1)
                );
            }
            else {
                $result = "-" . $this->additionWithoutSign(
                    substr($first, 1),
                    $second
                );
            }
        }
        else if ($second[0] === '-') {
            $result = $this->additionWithoutSign(
                $first,
                substr($second, 1)
            );
        }
        else {
            $result = $this->subtractionWithoutSign(
                $first,
                $second
            );
        }

        return $result;
    }

    /**
     * @param string $first
     * @param string $second
     */
    public function multiplication(string $first, string $second)
    {
        list($first, $second, $sign) = $this->getSignForMultiplication($first, $second);
        list($first, $second, $indentResult) = $this->getWhole($first, $second);

        $length = strlen($second);
        $result = 0;
        $indent = 0;

        for ($i = $length - 1; $i > -1; $i--) {
            list($curResult, $indent) = $this->multiplicationInt($first, $second[$i], $indent);

            $result = $this->addition($result, $curResult);
        }

        if ($indentResult != 0) {
            list($resultWhole, $resultWood) = $this->deleteZeros(
                substr($result, 0, strlen($result) - $indentResult),
                substr($result, strlen($result) - $indentResult, strlen($result) - 1)
            );
            return $sign . $this->getWholeOrWoodResult($resultWhole, $resultWood);
        }
        else {
            return $sign . $this->deleteZeros($result)[0];
        }
    }

    private function getSignForMultiplication($first, $second)
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

    private function getWholeAndWood($first, $second)
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
        else {
            $secondWhole = $second;
            $secondWood = '';
        }

        return $this->addZeros($firstWhole, $firstWood, $secondWhole, $secondWood);
    }

    private function addZeros($firstWhole, $firstWood, $secondWhole, $secondWood)
    {
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

    private function deleteZeros($resultWhole, $resultWood = '')
    {
        while ($resultWhole[0] === '0' and $resultWhole !== '0') {
            $resultWhole = substr($resultWhole, 1);
        }

        while (strlen($resultWood) > 0 and $resultWood[strlen($resultWood) - 1] === '0') {
            $resultWood = substr($resultWood, 0, - 1);
        }

        return array($resultWhole, $resultWood);
    }

    private function additionWithoutSign($first, $second)
    {
        list($firstWhole, $firstWood, $secondWhole, $secondWood) = $this->getWholeAndWood($first, $second);

        list($resultWood, $residue) = $this->additionInt($firstWood, $secondWood, 0);
        list($resultWhole, $residue) = $this->additionInt($firstWhole, $secondWhole, $residue);

        if ($residue !== 0) {
            $resultWhole = $residue . $resultWhole;
        }

        return $this->getWholeOrWoodResult($resultWhole, $resultWood);
    }

    private function additionInt($first, $second, $residue)
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

    private function subtractionWithoutSign($first, $second)
    {
        list($firstWhole, $firstWood, $secondWhole, $secondWood) = $this->getWholeAndWood($first, $second);

        if ($firstWhole . '.' . $firstWood >= $secondWhole . '.' . $secondWood) {
            $result = "";
            list($resultWood, $residue) = $this->subtractionInt($firstWood, $secondWood, 0);
            list($resultWhole, $residue) = $this->subtractionInt($firstWhole, $secondWhole, $residue);
        }
        else {
            $result = "-";
            list($resultWood, $residue) = $this->subtractionInt($secondWood, $firstWood, 0);
            list($resultWhole, $residue) = $this->subtractionInt($secondWhole, $firstWhole, $residue);
        }

        list($resultWhole, $resultWood) = $this->deleteZeros($resultWhole, $resultWood);

        return $result . $this->getWholeOrWoodResult($resultWhole, $resultWood);
    }

    private function getWholeOrWoodResult($resultWhole, $resultWood)
    {
        if ($resultWood == 0) {
            return  $resultWhole;
        }
        else {
            return  $resultWhole . '.' . $resultWood;
        }
    }

    private function subtractionInt($first, $second, $residue)
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

    private function getWhole($first, $second)
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

    private function multiplicationInt($number, $digit, $indent)
    {
        $length = strlen($number);
        $result = "";
        $residue = 0;

        for ($i = $length - 1; $i > -1; $i--) {
            $curMultiplication = $number[$i]*$digit + $residue;
            $result = ($curMultiplication % 10) . $result;
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