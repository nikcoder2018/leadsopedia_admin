<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Filter extends JsonResource
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
            'id' => $this->name,
            'text' => $this->name
        ];
    }
}
