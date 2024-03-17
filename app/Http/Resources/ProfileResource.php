<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'street1' => $this->userAttribute->street1 ?? '',
            'street2' => $this->userAttribute->street2 ?? '',
            'city' => $this->userAttribute->city ?? '',
            'postal_code' => $this->userAttribute->postal_code ?? '',
            'country_id' => $this->userAttribute->country_id ?? '',
        ];
    }
}
