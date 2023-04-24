<?php

namespace Bookkeeper\Booker\Http\Controllers;

use Bookkeeper\Booker\Actions\IndexReservationsAction;
use Bookkeeper\Booker\Http\Requests\IndexReservationsRequest;
use Bookkeeper\Booker\Http\Resources\ReservationsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationsController
{
    public function index(IndexReservationsRequest $request): AnonymousResourceCollection
    {
        /** @var IndexReservationsAction $action */
        $action = app(IndexReservationsAction::class);

        return ReservationsResource::collection($action->execute($request));
    }
}
