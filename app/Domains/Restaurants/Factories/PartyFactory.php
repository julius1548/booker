<?php

namespace App\Domains\Restaurants\Factories;

use App\Domains\Restaurants\Models\Party;
use Bookkeeper\Interface\Contracts\Abstracts\Factory;

class PartyFactory extends Factory
{
    function modelClass(): string
    {
        return Party::class;
    }
}
