<?php

namespace App\Domains\Restaurants\Http\Requests;

use Bookkeeper\Interface\Http\Request;

class StoreReservationRequest extends Request
{
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'from' => 'required|date',
            'to' => 'required|date',
            'contacts' => 'required|array',
            'contacts.*.first_name' => 'required|string',
            'contacts.*.last_name' => 'required|string',
            'contacts.*.email' => 'required|string|email',
            'contacts.*.country_code' => 'required_with:phone|string',
            'contacts.*.phone_number' => 'nullable|string',
        ];
    }
}
