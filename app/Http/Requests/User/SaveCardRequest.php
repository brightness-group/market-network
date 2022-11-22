<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SaveCardRequest extends FormRequest
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
            'name_on_card'    => 'required',
            'card_number'     => 'required|max:16',
            'expiration_date' => 'required',
            'security_code'   => 'required|max:3',
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
