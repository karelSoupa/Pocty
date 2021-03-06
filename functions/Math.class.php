<?php

class Math
{
    public function validate($number)
    {
        if (!filter_var($number, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException('Zadané číslo není ve správném tvaru');
        }
        return (int)$number;
    }

    public function generateSign($signArray)
    {
        return $signArray[mt_rand(0, count($signArray) - 1)];
    }

    public function generateNumbers($sign)
    {
        switch ($sign) {
            case '+':
                $numbers['numberA'] = mt_rand(1, 40);
                $numbers['numberB'] = mt_rand(1, 40);
                break;

            case '-':
                $numbers['numberA'] = mt_rand(1, 40);
                $numbers['numberB'] = mt_rand(1, 40);
                break;
            case '*':
                $numbers['numberA'] = mt_rand(1, 10);
                $numbers['numberB'] = mt_rand(1, 10);
                break;
            case '/':
                do {
                    $tempA = mt_rand(2, 81);
                    $tempB = mt_rand(2, 9);
                    $tempRes = $tempA / $tempB;
                } while (($tempA % $tempB !== 0) || ($tempA < $tempB) || ($tempRes > 9));
                $numbers['numberA'] = $tempA;
                $numbers['numberB'] = $tempB;
                break;
            default:
                throw new InvalidArgumentException('Neznámé znaménko');
        }
        return $numbers;
    }


    public function calculate($numberA, $numberB, $sign)
    {

        switch ($sign) {
            case '+':
                return $numberA + $numberB;
            case '-':
                return $numberA - $numberB;
            case '*':
                return $numberA * $numberB;
            case '/':
                return $numberA / $numberB;
            default:
                throw new InvalidArgumentException('Neznámé znaménko');
        }
    }
}