<?php

namespace App\Domains\Restaurants\Models;

use App\Domains\Restaurants\Traits\BelongsToRestaurant;
use Bookkeeper\Booker\Contracts\Interfaces\ReservableInterface;
use Bookkeeper\Booker\Models\Availability;
use Bookkeeper\Booker\Traits\MorphsReservations;
use Bookkeeper\Interface\Contracts\Abstracts\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

class Table extends Model implements ReservableInterface
{
    protected $table = 'restaurant_tables';

    use BelongsToRestaurant;
    use MorphsReservations;

    public function availabilities(): MorphToMany
    {
        return $this->morphToMany(Availability::class, 'reservable', 'reservable_availability');
    }

    /**
     * @return Collection|Availability[]
     */
    public function getAvailabilities(): Collection
    {
        return $this->getAttribute('availabilities');
    }

    public function getMaxOccupancy(): int
    {
        return $this->getAttribute('max_occupancy');
    }

    public function setMaxOccupancy(int $maxOccupancy): self
    {
        $this->setAttribute('max_occupancy', $maxOccupancy);
        return $this;
    }
}
