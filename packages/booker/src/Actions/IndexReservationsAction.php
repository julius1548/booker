<?php

namespace Bookkeeper\Booker\Actions;

use Bookkeeper\Booker\Models\Reservation;
use Bookkeeper\Interface\Contracts\Abstracts\Actions\IndexAction;

class IndexReservationsAction extends IndexAction
{

    function model(): string
    {
        return Reservation::class;
    }
}
