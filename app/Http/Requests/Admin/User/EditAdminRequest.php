<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EditAdminRequest extends FormRequest
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
        $userId = (int) request()->id;
        return [            
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$userId,
            'role_id' => 'required',
            'phone' => 'required:max:13',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required'  => 'Please select role'
        ]; 
    }
}
