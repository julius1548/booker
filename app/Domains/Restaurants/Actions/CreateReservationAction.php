<?php

namespace App\Domains\Restaurants\Actions;

use App\Domains\Restaurants\Exceptions\NoAvailableTablesException;
use App\Domains\Restaurants\Exceptions\OccupancyOverLimitException;
use App\Domains\Restaurants\Models\Restaurant;
use App\Domains\Restaurants\Services\OccupancyCheckService;
use App\Domains\Restaurants\Services\ReservationLockService;
use App\Domains\Restaurants\Services\TableSelectService;
use Bookkeeper\Booker\Actions\StoreReservationAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreateReservationAction
{
    public function __construct(private OccupancyCheckService  $occupancyCheckService,
                                private TableSelectService     $tableSelectService,
                                private StoreContactAction     $storeContactAction,
                                private StorePartyAction       $storePartyAction,
                                private StoreReservationAction $storeReservationAction
    )
    {
    }

    /**
     * @throws NoAvailableTablesException
     * @throws OccupancyOverLimitException
     */
    public function execute(array $data): void
    {
        /** @var Restaurant $restaurant */
        $restaurant = Restaurant::find($data['restaurant_id']);
        $from = Carbon::parse($data['from']);
        $to = Carbon::parse($data['to']);
        $contactData = $data['contacts'];

        ReservationLockService::lock($restaurant, $from, function () use ($restaurant, $from, $to, $contactData) {

            if (!$this->occupancyCheckService->check($restaurant, $from, $to, count($contactData))) {
                throw new OccupancyOverLimitException();
            }

            if (!$tables = $this->tableSelectService->select($restaurant, $from, $to, count($contactData))) {
                throw new NoAvailableTablesException();
            }

            DB::transaction(function () use ($tables, $from, $to, $contactData) {
                $contacts = array_map(function (array $data) {
                    $contact = $this->storeContactAction->execute($data);
                    $contact->save();
                    return $contact;

                }, $contactData);

                $party = $this->storePartyAction->execute($contacts[0], $contacts);

                foreach ($tables as $table) {
                    $this->storeReservationAction->execute($table, $party, $from, $to);
                }
            });
        });
    }
}
