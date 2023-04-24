<?php

namespace Bookkeeper\Booker\Models;

use Bookkeeper\Booker\Enums\PeriodicityType;
use Bookkeeper\Interface\Contracts\Abstracts\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Availability extends Model
{
    public function timelines(): HasMany
    {
        return $this->hasMany(AvailabilityTimeline::class);
    }

    /**
     * @return Collection|AvailabilityTimeline[]
     */
    public function getTimelines(): Collection
    {
        return $this->getAttribute('timelines');
    }

    public function getPeriodicityType(): PeriodicityType
    {
        return new PeriodicityType($this->getAttribute('periodicity_type'));
    }

    public function setPeriodicityType(PeriodicityType $periodicityType): self
    {
        $this->setAttribute('periodicity_type', $periodicityType->getValue());
        return $this;
    }
}
