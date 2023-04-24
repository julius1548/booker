<?php

namespace App\Domains\Restaurants\Http\Controllers;

use App\Domains\Restaurants\Actions\IndexRestaurantsAction;
use App\Domains\Restaurants\Http\Requests\IndexRestaurantsRequest;
use App\Domains\Restaurants\Http\Resources\RestaurantResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestaurantController
{
    public function index(IndexRestaurantsRequest $request): AnonymousResourceCollection
    {
        /** @var IndexRestaurantsAction $action */
        $action = app(IndexRestaurantsAction::class);

        return RestaurantResource::collection($action->execute($request));
    }
}
