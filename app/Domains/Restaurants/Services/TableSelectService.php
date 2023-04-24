<?php

namespace App\Domains\Restaurants\Services;

use App\Domains\Restaurants\Models\Restaurant;
use App\Domains\Restaurants\Models\Table;
use Bookkeeper\Booker\DataObjects\Time;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TableSelectService
{
    /** @return Table[] */
    public function select(Restaurant $restaurant, Carbon $from, Carbon $to, int $partySize): array
    {
        $timeFrom = (new Time())->fromString($from->format('H:i:s'));
        $timeTo = (new Time())->fromString($to->format('H:i:s'));

        $tables = Table::with('availabilities.timelines')
            ->where('restaurant_id', $restaurant->getId())
            ->whereHas('availabilities.timelines', function (Builder $query) use ($from, $timeFrom, $timeTo) {
                $query->where('day_no', $from->dayOfWeek + 1)
                    ->whereRaw('? between time_from and time_to', [$timeFrom->getSeconds()])
                    ->whereRaw('? between time_from and time_to', [$timeTo->getSeconds()]);
            })
            ->whereDoesntHave('reservations', function (Builder $query) use ($from, $to) {
                $query->whereNull('cancelled_at')
                    ->where(function (Builder $query) use ($from, $to) {
                        $query->whereBetween('from', [$from, $to]);
                        $query->orWhereBetween('to', [$from, $to]);
                    });
            })
            ->orderBy('max_occupancy', 'DESC')
            ->get();

        return $this->findTable($tables->all(), $partySize);
    }

    /**
     * @param Table[] $tableList
     */
    private function findTable(array $tableList, int $partySize, array $selectedTables = []): array
    {
        //Filters tables that can accommodate the party.
        $fitting = array_filter($tableList, function (Table $table) use ($partySize) {
            return $table->getMaxOccupancy() >= $partySize;
        });

        //If any table is found, the smallest one is selected to be reserved.
        if (!empty($fitting)) {
            usort($fitting, function (Table $t1, Table $t2) {
                return $t2->getMaxOccupancy() < $t1->getMaxOccupancy();
            });

            $selectedTables[] = $fitting[0];
            return $selectedTables;
        }

        //If table is not found, the largest one is selected and removed from the original list.
        if (!$selectedTable = array_shift($tableList)) {
            return [];
        }

        //Largest table added to list to be reserved.
        $selectedTables[] = $selectedTable;

        //Next table is found for the remainder of the party.
        $partySize -= $selectedTable->getMaxOccupancy();

        return $this->findTable($tableList, $partySize, $selectedTables);
    }
}
