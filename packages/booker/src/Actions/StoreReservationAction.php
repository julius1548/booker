<?php

namespace Bookkeeper\Booker\Actions;

use Bookkeeper\Booker\Contracts\Interfaces\ReservableInterface;
use Bookkeeper\Booker\Contracts\Interfaces\ReserveeInterface;
use Bookkeeper\Booker\Factories\ReservationFactory;
use Bookkeeper\Booker\Models\Reservation;
use Carbon\Carbon;

class StoreReservationAction
{
    public function execute(ReservableInterface $reservable, ReserveeInterface $reservee, Carbon $from, Carbon $to): Reservation
    {
        /** @var Reservation $reservation */
        $reservation = (new ReservationFactory)->make([
            'reservable_type' => $reservable->getType(),
            'reservable_id' => $reservable->getId(),
            'reservee_type' => $reservee->getType(),
            'reservee_id' => $reservee->getId(),
            'from' => $from,
            'to' => $to
        ]);

        $reservation->save();

        return $reservation;
    }
}
