<?php

namespace Bookkeeper\Booker\Traits;

use Bookkeeper\Booker\Models\Reservation;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait MorphsReservations
{
    public function reservations(): MorphMany
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }

    /** @return Collection|Reservation[] */
    public function getReservations(): Collection {
        return $this->getAttribute('reservations');
    }
}
