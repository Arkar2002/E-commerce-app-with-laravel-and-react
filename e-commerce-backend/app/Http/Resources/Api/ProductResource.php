<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "image" => $this->image_url,
            "salePrice" => $this->sale_price,
            "discountPrice" => $this->discount_price,
            "quantity" => $this->qty,
            "like" => $this->like_count,
            "rating" => $this->rating,
            "description" => $this->description,
            "date" => $this->updated_at,
            "category" => new CategoryResource($this->whenLoaded("category")),
            "brand" => new BrandResource($this->whenLoaded("brand")),
            "color" => $this->whenLoaded("color"),
        ];
    }
}
