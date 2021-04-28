<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Setting;
class Subscription extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $duration = '';

        if(!$this->is_trial){
            $duration = $this->months > 1 ? $this->months.' Months' : $this->months.' Month';
        }else{
            $duration = $this->days > 1 ? $this->days.' Days' : $this->days.' Day';
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'duration' => $duration,
            'price' => Setting::GetValue('currency_symbol').$this->price,
            'price_annual' => $this->price_annual != null ? Setting::GetValue('currency_symbol').$this->price_annual : ''
        ];
    }
}
