<?php

namespace Bookkeeper\Booker\Factories;

use Bookkeeper\Booker\Models\Reservation;
use Bookkeeper\Interface\Contracts\Abstracts\Factory;

class ReservationFactory extends Factory
{

    function modelClass(): string
    {
        return Reservation::class;
    }
}
