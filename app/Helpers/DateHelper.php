<?php
namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function now() : Carbon
    {
        return Carbon::now();
    } 
}