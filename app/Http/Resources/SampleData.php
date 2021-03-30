<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class SampleData extends JsonResource
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
            'req_id' => System::GenerateFormattedId('R', $this->id),
            'name' => $this->firstname.' '.$this->lastname,
            'email' => $this->email,
            'email' => $this->phone,
            'dataset' => $this->dataset,
            'status' => $this->status,
            'date' => $this->created_at->format('M d, Y')
        ];
    }
}
