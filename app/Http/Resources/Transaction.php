<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Setting;
class Transaction extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'customer' => $this->customer->name,
            'payment_method' => $this->method->name,
            'subscription' => $this->subscription->title,
            'amount' => Setting::GetValue('currency_symbol').' '.$this->amount,
            'status' => $this->status,
            'status_class' => Setting::GetStatusClass($this->status),
            'date' => $this->created_at->format('Y-m-d')
        ];
    }
}
