<?php

namespace App\Domains\Restaurants\Models;

use Bookkeeper\Interface\Contracts\Abstracts\Model;

class Contact extends Model
{
    public function getFirstName(): ?string
    {
        return $this->getAttribute('first_name');
    }

    public function setFirstName(?string $firstName): self
    {
        $this->setAttribute('first_name', $firstName);
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->getAttribute('last_name');
    }

    public function setLastName(?string $lastName): self
    {
        $this->setAttribute('last_name', $lastName);
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->getAttribute('email');
    }

    public function setEmail(?string $email): self
    {
        $this->setAttribute('email', $email);
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->getAttribute('country_code');
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->setAttribute('country_code', $countryCode);
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->getAttribute('phone_number');
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->setAttribute('phone_number', $phoneNumber);
        return $this;
    }
}
