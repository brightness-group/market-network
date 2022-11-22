<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SaveContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::user()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [            
            'full_name'       => 'required',
            'address'         => 'required',
            'address_number'  => 'required',
            'country_id'      => 'required',
            'state_id'        => 'required',
            'phone'           => 'required:max:13',
        ];
    }

    public function messages()
    {
        return [
            'country_id.required'  => 'Country is required',
            'state_id.required'   => 'Emirates is required'
        ]; 
    }

}
