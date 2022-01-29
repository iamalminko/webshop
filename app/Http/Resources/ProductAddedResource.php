<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAddedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'product' => [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'name' => $this->product->name,
                'image' => $this->product->image,
                'price' => number_format($this->product->price/100, 2),
                'discount' => $this->product->discount,
            ]
        ];
    }
}
