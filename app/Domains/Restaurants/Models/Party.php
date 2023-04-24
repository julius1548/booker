<?php

namespace App\Domains\Restaurants\Models;

use Bookkeeper\Booker\Contracts\Interfaces\ReserveeInterface;
use Bookkeeper\Interface\Contracts\Abstracts\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Party extends Model implements ReserveeInterface
{
    public function mainContact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'main_contact_id', 'id');
    }

    public function getMainContact(): Contact
    {
        return $this->getAttribute('contact');
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'party_contacts');
    }

    /**
     * @return Contact[]|Collection
     */
    public function getContacts(): Collection
    {
        return $this->getAttribute('contacts');
    }

    public function getSize(): int
    {
        return $this->getAttribute('size');
    }

    public function setSize(int $size): self
    {
        $this->setAttribute('size', $size);
        return $this;
    }

    public function getMainContactId(): int
    {
        return $this->getAttribute('main_contact_id');
    }

    public function setMainContactId(int $mainContactId): self
    {
        $this->setAttribute('main_contact_id', $mainContactId);
        return $this;
    }
}
