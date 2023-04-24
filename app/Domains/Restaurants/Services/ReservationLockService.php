<?php

namespace App\Domains\Restaurants\Services;

use App\Domains\Restaurants\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ReservationLockService
{
    public static function lock(Restaurant $restaurant, Carbon $day, \Closure $callback)
    {
        $lock = Cache::lock(self::lockName($restaurant, $day), 10);
        try {
            $lock->block(5);
            $callback();
            return true;
        } finally {
            $lock?->release();
        }
    }

    private static function lockName(Restaurant $restaurant, Carbon $day): string
    {
        return "restaurant:{$restaurant->getId()}:reservation:{$day->format('Y-m-d')}";
    }
}
