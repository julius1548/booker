<?php

namespace App\Domains\Restaurants\Actions;

use App\Domains\Restaurants\Factories\ContactFactory;
use Bookkeeper\Interface\Contracts\Abstracts\Model;

class StoreContactAction
{
    public function execute(array $data): Model
    {
        $contact = (new ContactFactory)->make($data);
        $contact->save();

        return $contact;
    }
}
