<?php

namespace App\Domains\Restaurants\Models;

use Bookkeeper\Interface\Contracts\Abstracts\Model;

class Restaurant extends Model
{
    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    public function getMaxOccupancy(): int
    {
        return $this->getAttribute('max_occupancy');
    }

    public function setMaxOccupancy(int $maxOccupancy): self
    {
        $this->setAttribute('max_occupancy', $maxOccupancy);
        return $this;
    }
}
