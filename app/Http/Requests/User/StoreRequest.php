<?php

namespace App\Http\Requests\User;

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
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,'.Auth::user()->id,
            'city_id'  => 'required',
            'bio'      => 'string',
            'facebook' => 'nullable|url',
            'twitter'  => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube'   => 'nullable|url',
            'behance'   => 'nullable|url',
            'profession_id'  => 'nullable',
            'avatar'  => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'facebook.url'  => 'Facebook url is invalid',
            'twitter.url'   => 'Twitter url is invalid',
            'instagram.url' => 'Instagram url is invalid',
            'youtube.url'   => 'Youtube url is invalid',
            'behance.url'   => 'Behance url is invalid',
        ]; 
    }

}
