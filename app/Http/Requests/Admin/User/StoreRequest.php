<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [            
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'city_id' => 'nullable',
            'bio'     => 'required',
            'account_type' => 'required',
            'avatar'  => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'The fullname field is required.',
            'email.required' => 'The email address field is required.'
        ];
    }
}
