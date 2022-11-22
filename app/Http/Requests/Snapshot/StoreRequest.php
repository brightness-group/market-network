<?php

namespace App\Http\Requests\Snapshot;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Rules\MaxWordsRule;

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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required_if:draft,false',
            "bronze.price" => "required_if:bronze.keep_current_setting,false|integer",
            "bronze.offer" => "required_if:bronze.keep_current_setting,false",
            "bronze.per_price" => "required_if:bronze.keep_current_setting,false",
            "bronze.quantity" => "required_if:bronze.keep_current_setting,false|integer",
            "bronze.description" => "max:200",
            "silver.price" => "required_if:silver.keep_current_setting,false|integer",
            "silver.offer" => "required_if:silver.keep_current_setting,false",
            "silver.per_price" => "required_if:silver.keep_current_setting,false",
            "silver.quantity" => "required_if:silver.keep_current_setting,false|integer",
            "silver.description" => "max:200",
            "gold.price" => "required_if:gold.keep_current_setting,false|integer",
            "gold.offer" => "required_if:gold.keep_current_setting,false",
            "gold.per_price" => "required_if:gold.keep_current_setting,false",
            "gold.quantity" => "required_if:gold.keep_current_setting,false|integer",
            "gold.description" => "max:200",
            'upsell_title' => 'required_if:upsell,true',
            'upsell_price' => 'required_if:upsell,true',
            'upsell_description' => [
                'required_if:upsell,true',
                new MaxWordsRule(100),
            ]
        ];
    }

    
    public function messages() {

        return [
            'title.required'        => 'Snapshot Title is required',
            'category_id.required'     => 'Snapshot Category is required',
            'category_id.required_if'  => 'Snapshot Category is required',
            'description.required_if'  => 'Snapshot Description is required',
            'bronze.offer.required_if'    => 'Snapshot Package : Bronze - Please add Offer',
            'silver.offer.required_if'    => 'Snapshot Package : Silver - Please add Offer',
            'gold.offer.required_if'      => 'Snapshot Package : Gold - Please add Offer',
            'bronze.per_price.required_if'    => 'Snapshot Package : Bronze - Please add Price',
            'silver.per_price.required_if'    => 'Snapshot Package : Silver - Please add Price',
            'gold.per_price.required_if'      => 'Snapshot Package : Gold - Please add Price',
            'bronze.price.required_if'        => 'Snapshot Package : Bronze - Price field is required',
            'silver.price.required_if'        => 'Snapshot Package : Silver - Price field is required',
            'gold.price.required_if'          => 'Snapshot Package : Gold - Price field is required',
            'bronze.price.integer'            => 'Snapshot Package : Bronze - Price must be an integer',
            'silver.price.integer'            => 'Snapshot Package : Silver - Price must be an integer',
            'gold.price.integer'              => 'Snapshot Package : Gold - Price must be an integer',
            'bronze.description.max'          => 'Snapshot Package : Bronze - Description must not be greater than 200 characters',
            'silver.description.max'          => 'Snapshot Package : Silver - Description must not be greater than 200 characters',
            'gold.description.max'            => 'Snapshot Package : Gold - Description must not be greater than 200 characters',
            'bronze.quantity.integer'         => 'Snapshot Package : Bronze - Quantity must be an integer',
            'silver.quantity.integer'         => 'Snapshot Package : Silver - Quantity must be an integer',
            'gold.quantity.integer'           => 'Snapshot Package : Gold - Quantity must be an integer',
            'bronze.quantity.required_if'     => 'Snapshot Package : Bronze - Quantity is required',
            'silver.quantity.required_if'     => 'Snapshot Package : Silver - Quantity is required',
            'gold.quantity.required_if'       => 'Snapshot Package : Gold - Quantity is required',
            'upsell_title.required_if'        => 'Upsell title is required',
            'upsell_price.required_if'        => 'Upsell price is required',
            'upsell_description.required_if'  => 'Upsell description is required',
        ];    
    }

}
