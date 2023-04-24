<?php

namespace Bookkeeper\Booker\Models;

use Bookkeeper\Interface\Contracts\Abstracts\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reservation extends Model
{
    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function reservable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getReservable(): mixed
    {
        return $this->getAttribute('reservable');
    }

    public function reservee(): MorphTo
    {
        return $this->morphTo();
    }

    public function getReservee(): mixed
    {
        return $this->getAttribute('reservee');
    }

    public function getReservableId(): int
    {
        return $this->getAttribute('reservable_id');
    }

    public function setReservableId(int $reservableId): self
    {
        $this->setAttribute('reservable_id', $reservableId);
        return $this;
    }

    public function getReservableType(): string
    {
        return $this->getAttribute('reservable_type');
    }

    public function setReservableType(string $reservableType): self
    {
        $this->setAttribute('reservable_type', $reservableType);
        return $this;
    }

    public function getReserveeId(): int
    {
        return $this->getAttribute('reservee_id');
    }

    public function setReserveeId(int $reserveeId): self
    {
        $this->setAttribute('reservee_id', $reserveeId);
        return $this;
    }

    public function getReserveeType(): string
    {
        return $this->getAttribute('reservee_type');
    }

    public function setReserveeType(string $reserveeType): self
    {
        $this->setAttribute('reservee_type', $reserveeType);
        return $this;
    }

    public function getFrom(): Carbon
    {
        return $this->getAttribute('from');
    }

    public function setFrom(Carbon $from): self
    {
        $this->setAttribute('from', $from);
        return $this;
    }

    public function getTo(): Carbon
    {
        return $this->getAttribute('to');
    }

    public function setTo(Carbon $to): self
    {
        $this->setAttribute('to', $to);
        return $this;
    }

    public function getCancelledAt(): Carbon
    {
        return $this->getAttribute('cancelled_at');
    }

    public function setCancelledAt(Carbon $cancelledAt): self
    {
        $this->setAttribute('cancelled_at', $cancelledAt);
        return $this;
    }
}
