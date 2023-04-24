<?php

namespace Bookkeeper\Booker\Http\Controllers;

use Bookkeeper\Booker\Actions\IndexAvailabilityTimelinesAction;
use Bookkeeper\Booker\Http\Requests\IndexAvailabilityTimelinesRequest;
use Bookkeeper\Booker\Http\Resources\AvailabilityTimelineResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AvailabilityTimelinesController
{
    public function index(IndexAvailabilityTimelinesRequest $request): AnonymousResourceCollection
    {
        /** @var IndexAvailabilityTimelinesAction $action */
        $action = app(IndexAvailabilityTimelinesAction::class);

        return AvailabilityTimelineResource::collection($action->execute($request));
    }
}
