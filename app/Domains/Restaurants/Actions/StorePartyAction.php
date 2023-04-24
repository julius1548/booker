<?php

namespace App\Domains\Restaurants\Actions;

use App\Domains\Restaurants\Factories\PartyFactory;
use App\Domains\Restaurants\Models\Contact;
use App\Domains\Restaurants\Models\Party;

class StorePartyAction
{
    /**
     * @param Contact $mainContact
     * @param Contact[] $contacts
     * @return Party
     */
    public function execute(Contact $mainContact, array $contacts): Party
    {
        /** @var Party $party */
        $party = (new PartyFactory)->make([
            'main_contact_id' => $mainContact->getId(),
            'size' => count($contacts)
        ]);
        $party->save();
        foreach ($contacts as $contact) {
            $party->contacts()->attach($contact->getId());
        }

        return $party;
    }
}
