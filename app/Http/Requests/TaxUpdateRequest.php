<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxUpdateRequest extends FormRequest{
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
    public function rules(){
        return  [
            "name" => 'nullable|string|max:100',
            "tax_percent" => 'required',
            'state' => 'required',
            'status' => 'required',
        ];
    }

    public function attributes(){
        return [
            "tax_percent" => 'tax',
        ];
    }
}