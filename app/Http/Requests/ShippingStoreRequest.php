<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "zone_name" => 'nullable|string|max:100',
            "amount" => 'required|numeric|between:1,499.99',
            'state' => 'required|string',
            'status' => 'required'
        ];
    }
}