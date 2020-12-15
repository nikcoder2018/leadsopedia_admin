<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Integration extends JsonResource
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
            'app_key' => $this->app_key,
            'description' => $this->description,
            'image' => $this->image,
            'status' => $this->status,
            'scope' => $this->scope,
            'group' => $this->group
        ];
    }
}
