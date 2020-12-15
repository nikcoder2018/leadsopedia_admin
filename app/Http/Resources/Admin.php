<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Admin extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_status' => $this->email_verified_at != null ? 'verified' : 'not_verified',
            'roles' => $this->roles,
            'status' => $this->status ? 'active' : 'inactive'
        ];
    }
}
