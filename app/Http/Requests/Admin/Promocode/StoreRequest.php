<?php

namespace App\Http\Requests\Admin\Promocode;

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
            'promocode' => 'required|string|max:8',
            'discount' => 'required|integer|between:1,100',
            'expiry_date' => 'required_if:is_expiry_date_checked,true',
            'usage_limit' => 'required_if:is_usage_limit_checked,true',
            'is_expiry_date_checked' => 'boolean',
            'is_usage_limit_checked' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'expiry_date.required_if' => 'The expiry date field is required when expiry date checkbox is checked',
            'usage_limit.required_if' => 'The usage limit field is required when usage limit checkbox is checked'
        ];
    }
}
