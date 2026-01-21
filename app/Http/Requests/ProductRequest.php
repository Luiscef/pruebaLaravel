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
            'name' => 'required|min:3|max:50',
            'price' => 'required|numeric', 
        ];
    }
    public function messages(): array
{
    return [
        'name.required' => 'El nombre del producto es obligatorio.',
        'name.min' => 'El nombre debe tener al menos 3 caracteres.',
        'name.max' => 'El nombre no puede superar los 50 caracteres.',
        'price.required' => 'El precio es obligatorio.',
        'price.numeric' => 'El precio debe ser un número.',
        'price.min' => 'El precio mínimo es 1.',
        'price.max' => 'El precio máximo es 1000.',
    ];
}
}
