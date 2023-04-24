<?php

namespace Bookkeeper\Booker\Models;

use Bookkeeper\Booker\DataObjects\Time;
use Bookkeeper\Booker\Traits\BelongsToAvailability;
use Bookkeeper\Interface\Contracts\Abstracts\Model;

class AvailabilityTimeline extends Model
{
    use BelongsToAvailability;

    public function getTimeFrom(): Time
    {
        return new Time($this->getAttribute('time_from'));
    }

    public function setTimeFrom(Time $timeFrom): self
    {
        $this->setAttribute('time_from', $timeFrom->getSeconds());
        return $this;
    }

    public function getTimeTo(): Time
    {
        return new Time($this->getAttribute('time_to'));
    }

    public function setTimeTo(Time $timeTo): self
    {
        $this->setAttribute('time_to', $timeTo->getSeconds());
        return $this;
    }

    public function getDayNo(): int
    {
        return $this->getAttribute('day_no');
    }

    public function setDayNo(int $dayNo): self
    {
        $this->setAttribute('day_no', $dayNo);
        return $this;
    }
}
