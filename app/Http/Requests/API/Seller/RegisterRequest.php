<?php

namespace App\Http\Requests\API\Seller;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => ['required','regex:/^[a-zA-Z\s]*$/'],
            'lastname'=>['required','regex:/^[a-zA-Z\s]*$/'],
            'store_name'=>'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            // 'category' => '',
            // 'city' => '',
            // 'detail_address'=>'',
            // 'products'=>'',
            // 'review'=>'',
            // 'followers'=>''
        ];
    }
}
