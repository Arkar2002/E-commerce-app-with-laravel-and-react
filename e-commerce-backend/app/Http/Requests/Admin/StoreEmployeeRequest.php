<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone",
            "image" => "required|mimes:png,jpg,jpeg,webp|max:2048",
            "password" => "required|confirmed|min:6",
            "gender" => ["required", Rule::in(["male", "female"])],
            "address" => "required|string",
        ];
    }
}
