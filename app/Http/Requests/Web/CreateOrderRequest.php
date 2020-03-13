<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pizza' => 'required',
            'quantity' => 'required|integer',
            'size' => 'required',
            'name' => 'required|string',
            'address' => 'required',
            'status' => 'required'
        ];
    }
}
