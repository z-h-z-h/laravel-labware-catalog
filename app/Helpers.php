<?php

namespace App;
class Helpers
{
    public static function quantity($number, $word)
    {

        $divideForHundredNumber = $number % 100;

        if ($divideForHundredNumber >= 11 && $divideForHundredNumber <= 14) {
            $index = 2;
        } else {
            $divideForTenNumber = $number % 10;
            if ($divideForTenNumber == 0 || $divideForTenNumber > 4) {
                $index = 2;
            } elseif ($divideForTenNumber == 1) {
                $index = 0;
            } elseif ($divideForTenNumber > 1 && $divideForTenNumber < 5) {
                $index = 1;
            }

        }

        return $word[$index];
    }
}

