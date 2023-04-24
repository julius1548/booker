<?php

namespace App\Domains\Restaurants\Services;

use App\Domains\Restaurants\Models\Restaurant;
use App\Domains\Restaurants\Models\Table;
use Bookkeeper\Booker\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class OccupancyCheckService
{
    public function check(Restaurant $restaurant, Carbon $from, Carbon $to, int $partySize): bool
    {
        /** @var Reservation[] $existingReservations */
        $existingReservations = Reservation::where('reservable_type', Table::class)
            ->whereHas('reservable', function (Builder $query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->getId());
            })
            ->whereNull('cancelled_at')
            ->where(function (Builder $query) use ($from, $to) {
                $query->whereBetween('from', [$from, $to]);
                $query->orWhereBetween('to', [$from, $to]);
            })
            ->get()
            ->all();

        if (!$existingReservations) {
            return $partySize <= $restaurant->getMaxOccupancy();
        }

        $occupancyTimeline = static::buildTimeline($existingReservations);

        //Filters timeline items only within new reservation period.
        $occupancyTimeline = array_filter($occupancyTimeline, function ($timestamp) use ($from, $to) {
            return $from->timestamp < $timestamp && $timestamp <= $to->timestamp;
        }, ARRAY_FILTER_USE_KEY);


        //Filters timeline items with occupancy greater than max restaurant occupancy after adding the new party.
        $overLimit = array_filter($occupancyTimeline, function ($occupancySize) use ($restaurant, $partySize) {
            return $occupancySize + $partySize > $restaurant->getMaxOccupancy();
        });

        return empty($overLimit);
    }

    /**
     * Builds a timeline with an occupancy number every given amount of seconds.
     */
    private static function buildTimeline(array $existingReservations, int $delta = 1800): array
    {
        $reserveeTimelines = [];
        $occupancyTimeline = [];
        foreach ($existingReservations as $reservation) {
            $start = $reservation->getFrom()->timestamp;
            $end = $reservation->getTo()->timestamp;
            $current = $start;
            while ($current <= $end) {

                //To avoid duplicating occupancy if same reservee has multiple table reservations.
                $reservee = $reservation->getReservee();
                $reserveeTimeline = $reserveeTimelines[$reservee->getId()] ?? [];
                if (in_array($current, $reserveeTimeline)) {
                    $current += $delta;
                    continue;
                }


                $reserveeTimeline[] = $current;
                $reserveeTimelines[$reservee->getId()] = $reserveeTimeline;

                $existing = $occupancyTimeline[$current] ?? 0;
                $partySize = $reservee->getSize();
                $occupancyTimeline[$current] = $existing + $partySize;
                $current += $delta;
            }
        }

        return $occupancyTimeline;
    }
}
