<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|unique:items,name",
            "price" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            "photo" => "required|mimes:png,jpg,webp|max:4000"
        ];
    }

    public function messages()
    {
        return [
            "category_id.exists" => "Invalid category."
        ];
    }
}
