<?php

namespace Bookkeeper\Booker\Traits;

use Bookkeeper\Booker\Models\Availability;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToAvailability
{
    public function availability(): BelongsTo
    {
        return $this->belongsTo(Availability::class);
    }

    public function getAvailability(): Availability
    {
        return $this->getAttribute('availability');
    }

    public function getAvailabilityId(): int
    {
        return $this->getAttribute('availability_id');
    }

    public function setAvailabilityId(int $availabilityId): self
    {
        $this->setAttribute('availability_id', $availabilityId);
        return $this;
    }
}
