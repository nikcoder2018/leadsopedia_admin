<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
            'responsive_id' => '',
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'email_status' => $this->email_verified_at != null ? 'verified' : 'not_verified',
            'company' => $this->company,
            'referrals' => $this->countReferrals,
            'status' => $this->status ? 'active' : 'inactive',
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
