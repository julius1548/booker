<?php

namespace Bookkeeper\Booker\Http\Resources;

use Bookkeeper\Interface\Http\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ReservationsResource extends Resource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        $resource = parent::toArray($request);
        $resource['from'] = $this->resource->getFrom()->format('Y-m-d H:i:s');
        $resource['to'] = $this->resource->getTo()->format('Y-m-d H:i:s');
        $resource['reservable'] = $this->resource->getReservable()->only(['id', 'max_occupancy', 'restaurant_id']);
        $resource['reservee'] = $this->resource->getReservee()->only(['id', 'size']);

        return $resource;
    }
}
