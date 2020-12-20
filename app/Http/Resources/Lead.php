<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lead extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'responsive_id' => 0,
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'company' => $this->company,
            'industry' => $this->industry,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'region' => $this->region,
            'country' => $this->country,
        ];
    }
}
