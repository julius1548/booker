<?php

namespace Bookkeeper\Booker\Http\Resources;

use Bookkeeper\Booker\DataObjects\Time;
use Bookkeeper\Interface\Http\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class AvailabilityTimelineResource extends Resource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        $resource = parent::toArray($request);
        $resource['time_from'] = (string)$this->resource->getTimeFrom();
        $resource['time_to'] = (string)$this->resource->getTimeTo();

        return $resource;
    }
}
