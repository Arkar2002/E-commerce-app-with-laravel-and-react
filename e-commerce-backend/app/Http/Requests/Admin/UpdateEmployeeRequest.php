<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
        $id = $this->route('employee')->id;
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email," . $id,
            "phone" => "required|unique:users,phone," . $id,
            "image" => "nullable|mimes:png,jpg,jpeg,webp|max:2048",
            "password" => "nullable|confirmed|min:6",
            "gender" => ["required", Rule::in(["male", "female"])],
            "address" => "required|string",
        ];
    }
}
