<?php

namespace App\Domains\Restaurants\Factories;

use App\Domains\Restaurants\Models\Contact;
use Bookkeeper\Interface\Contracts\Abstracts\Factory;

class ContactFactory extends Factory
{
    function modelClass(): string
    {
        return Contact::class;
    }
}
