<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'category_id' => 'required|array',
            "category_id.*"  => "required|distinct",
            'city_id' => 'nullable',
            'avatar'  => 'image|mimes:jpeg,png,jpg|max:2048',
            'bio'     => 'string'
        ];
    }

    public function messages()
    {
        return [
            'category_id.*'  => 'Category id is required'
        ]; 
    }

}
