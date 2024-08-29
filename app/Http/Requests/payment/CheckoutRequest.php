<?php

namespace App\Http\Requests\payment;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:100',
            'address' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|min:9',
            'quantity' => 'required|min:1',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name is too long',
            'address.required' => 'Address is required',
            'email.email' => 'Email is not valid',
            'phone.min' => 'Phone is too short',
            'quantity.min' => 'Quantity is too short',
            'product_id.exists' => 'Product not found',
        ];
    }
}
