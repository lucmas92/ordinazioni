<?php

namespace Lucmas\Reservations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
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
            'product_id' => $this->id,
            'price' => $this->price,
            'name' => $this->name,
            'quantity' => $this->pivot->quantity,
            'subtot' => $this->price * $this->pivot->quantity
        ];
    }
}
