<?php

namespace App\Domains\Restaurants\Actions;

use App\Domains\Restaurants\Models\Restaurant;
use Bookkeeper\Interface\Contracts\Abstracts\Actions\IndexAction;

class IndexRestaurantsAction extends IndexAction
{
    function model(): string
    {
        return Restaurant::class;
    }
}
