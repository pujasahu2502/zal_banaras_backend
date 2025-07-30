<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|email:rfc,dns|max:40',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
            'description' => 'required|max:350',
            'subject' => 'required|string|max:100',

        ];
    }
    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages(){
        return [
            'mobile_number.required'  => 'The mobile number field is required.',
            'mobile_number.max'     => 'The mobile number must not be greater than 13 numbers.',
            'mobile_number.min'    => 'The mobile number must be at least 10 numbers.',
            'description.max' => 'The message must not be greater than 350 characters.'
        ];
    }
}
