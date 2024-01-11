<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|unique:products,name",
            "image" => "required|mimes:png,jpg,jpeg,webp|max:2048",
            "category_id" => "required",
            "brand_id" => "required",
            "supplier_id" => "required",
            "qty" => "required",
            "buy_price" => "required",
            "sale_price" => "required",
            "discount_price" => "required",
            "description" => "required|string",
            "colors" => "required|array",
        ];
    }
}
