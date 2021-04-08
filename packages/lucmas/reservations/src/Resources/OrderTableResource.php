<?php

namespace Lucmas\Reservations\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $allProducts = $this->order->allproducts;
        $products = [];
        foreach ($allProducts as $product) {
            $products[$product->code] = isset($products[$product->code])
                ? $products[$product->code]['quantity'] + $product->pivot->quantity
                : $product->pivot->quantity;
        }

        return [
            "id" => $this->id,
            "number" => $this->number,
            "order" => [
                'id' => $this->order->id,
                'number' => $this->order->number,
                'table_id' => $this->order->table_id,
                'status' => $this->order->status,
                'allproducts' => [$products],
            ],
        ];
    }
}
