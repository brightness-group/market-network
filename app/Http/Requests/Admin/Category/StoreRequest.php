<?php

namespace App\Http\Requests\Admin\Category;

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
        $catId = (int) request()->cat_id;
        if ($catId) {
            return [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:categories,slug,'.$catId,
                'description' => 'required',
                'parent_id'     => 'required',
                'banner'  => 'required_if:is_edit,0|image|mimes:jpeg,png,jpg|max:10240',
            ];
        } else {            
            return [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:categories,slug',
                'description' => 'required',
                'parent_id'     => 'required',
                'banner'  => 'required_if:is_edit,0|image|mimes:jpeg,png,jpg|max:10240',
            ];
        }
    }
    
    public function messages()
    {
        return [
            'banner.required_if' => 'Please upload banner'
        ];
    }
}
