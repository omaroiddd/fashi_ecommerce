<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|string|min:5',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'category_id' => 'required|string',
            'brand_id' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png,gif,webp',
            'sale_percentage' => 'nullable|numeric|min:0|max:100',
            'tags' => 'nullable|array',
            'tags.*' => 'distinct|string|between:1,50',
        ];
    }
}
