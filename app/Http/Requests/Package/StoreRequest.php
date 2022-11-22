<?php

namespace App\Http\Requests\Package;
use Auth;

use Illuminate\Foundation\Http\FormRequest;

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
            "bronze.price" => "required_if:draft,false|integer",
            "bronze.per_price" => "required_if:draft,false",
            "bronze.description" => "required_if:draft,false|max:200",
            "bronze.includes" => "required_if:draft,false",
            "silver.price" => "required_if:draft,false|integer",
            "silver.per_price" => "required_if:draft,false",
            "silver.description" => "required_if:draft,false|max:200",
            "silver.includes" => "required_if:draft,false",
            "gold.price" => "required_if:draft,false|integer",
            "gold.per_price" => "required_if:draft,false",
            "gold.description" => "required_if:draft,false|max:200",
            "gold.includes" => "required_if:draft,false",
        ];
    }

    public function messages() {

        return [
            'bronze.per_price.required_if'    => 'Bronze - Price Per field is required',
            'silver.per_price.required_if'    => 'Silver - Price Per field is required',
            'gold.per_price.required_if'      => 'Gold - Price Per field is required',
            'bronze.price.required_if'       => 'Bronze - Price field is required',
            'silver.price.required_if'       => 'Silver - Price field is required',
            'gold.price.required_if'         => 'Gold - Price field is required',
            'bronze.price.integer'           => 'Bronze - Price must be an integer',
            'silver.price.integer'           => 'Silver - Price must be an integer',
            'gold.price.integer'             => 'Gold - Price must be an integer',
            'bronze.description.max'         => 'Bronze - Description must not be greater than 200 characters',
            'silver.description.max'         => 'Silver - Description must not be greater than 200 characters',
            'gold.description.max'           => 'Gold - Description must not be greater than 200 characters',
            'bronze.description.required_if'  => 'Bronze - Description field is required',
            'silver.description.required_if'  => 'Silver - Description field is required',
            'gold.description.required_if'    => 'Gold - Description field is required',
            'bronze.includes.required_if'     => 'Bronze - What is included field is required',
            'silver.includes.required_if'     => 'Silver - What is included field is required',
            'gold.includes.required_if'       => 'Gold - What is included field is required',
        ];    
    }
}
