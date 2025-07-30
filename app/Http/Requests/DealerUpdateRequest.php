<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealerUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:100', //unique:dealer,title,'.$this->id.',id
            'email' => 'nullable|email|email:rfc,dns|max:40', //unique:admins,email,'.$this->id.',id
            'phone' => 'nullable|min:10|max:13', //regex:/^([0-9\s\-\+\(\)]*)$/
            'address' => 'required|string|max:255',
            'state' => 'required|string',
            'city' => 'required|string|max:50',
            'country' => 'required|string',
            'status' => 'required|numeric',
            'zipcode' => 'required|between:4,7',
            'latitude' => 'required|regex:/^[-+]?[0-9]+\.[0-9]+$/|max:15',
            'longitude' => 'required|regex:/^[-+]?[0-9]+\.[0-9]+$/|max:15',
            'website_url' => 'nullable|url|max:150'
        ];
    }

    public function messages(){
        return [
            'phone.max'     => 'The mobile number must not be greater than 13 numbers.',
            'phone.min'    => 'The mobile number must be at least 10 numbers.',
        ];
    }
}
