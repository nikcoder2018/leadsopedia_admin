<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Setting;
class DashboardTransaction extends JsonResource
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
            'customer' => [
                'name' => $this->customer->name,
                'email' => $this->customer->email
            ],
            'subscription' => [
                'title'=>$this->subscription->title,
                'type' => $this->type
            ],
            'amount' => Setting::GetValue('currency_symbol').$this->amount,
            'when' => $this->created_at->diffForHumans()
        ];
    }
}
