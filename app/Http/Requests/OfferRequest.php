<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
            'photo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('messages.Offer Name ar'),
            'name_en.required' => __('messages.Offer Name en'),
            'name_ar.unique' =>  __('messages.offer name must be unique'),
            'name_en.unique' =>  __('messages.offer name must be unique'),
            'details_ar.required' => __('messages.Offer details ar'),
            'details_en.required' => __('messages.Offer details en'),
            'price.required' => __('messages.Offer Price required') ,
            'price.numeric' => __('messages.offfer price must be numeric'),
            'photo.required'=>__('messages.photo required')
            
        ];
    }
    
}
