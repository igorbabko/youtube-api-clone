<?php

namespace App\Enums;

use Illuminate\Support\Carbon;

enum Period: string
{
    case Year = 'year';
    case Month = 'month';
    case Week = 'week';
    case Day = 'day';
    case Hour = 'hour';

    public function date(): Carbon
    {
        return match ($this) {
            static::Year => now()->startOfYear(),
            static::Month => now()->startOfMonth(),
            static::Week => now()->startOfWeek(),
            static::Day => now()->startOfDay(),
            static::Hour => now()->startOfHour(),
        };
    }
}
