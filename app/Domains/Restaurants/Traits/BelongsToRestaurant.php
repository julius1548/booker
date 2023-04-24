<?php

namespace App\Domains\Restaurants\Traits;

use App\Domains\Restaurants\Models\Restaurant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRestaurant
{
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRestaurant(): Restaurant
    {
        return $this->getAttribute('restaurant');
    }

    public function getRestaurantId(): int
    {
        return $this->getAttribute('restaurant_id');
    }

    public function setRestaurantId(int $restaurantId): self
    {
        $this->setAttribute('restaurant_id', $restaurantId);
        return $this;
    }
}
