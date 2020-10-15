<?php

namespace App\Http\Managers;

use Illuminate\Support\Facades\Auth;

class PaymentManager
{

    public function getInstructorPart($total)
    {
        $percent = 75;
        $percent_decimal = $percent / 100;
        $part = $total * $percent_decimal;
        return $part;
    }

    public function getElearningPart($total)
    {
        $percent = 25;
        $percent_decimal = $percent / 100;
        $part = $total *  $percent_decimal;
        return $part;
    }
}
