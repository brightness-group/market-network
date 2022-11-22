<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/'
        ];
    }

    public function messages() {
        return [
            'new_password.required' => 'Password is required.',
            'new_password.regex' => 'Your password must be at-least 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric.'
        ];
    }
}
