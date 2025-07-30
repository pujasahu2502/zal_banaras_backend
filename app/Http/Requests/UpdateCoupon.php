<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Route;

class UpdateCoupon extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = Route::input('id');

        return
            [
                'code' => ['required', 'string', 'max:255', 'unique:coupons,code,'.$id,],
                'amount' => 'required',
            ];
    }

    
    public function failedValidation(Validator $validator)
    {
        return response()->json([
            'status' => 'error', 'error' => $validator->errors()->first(),
          ]);
    }
    
}
