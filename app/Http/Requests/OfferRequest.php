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
        return[
            'name_ar'=>'required|max:100|unique:offer,name_ar',
            'name_en'=>'required|max:100|unique:offer,name_en',
            'pric'=>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('massages.offer name required ar'),
            'name_ar.max' =>  __('massages.offer name max ar'),
            'name_ar.unique' => __('massages.offer name unique ar'),
            'name_en.required' => __('massages.offer name required en'),
            'name_en.max' =>  __('massages.offer name max en'),
            'name_en.unique' => __('massages.offer name unique en'),
            'pric.required' => __('massages.offer pric required'),
            'pric.numeric' => __('massages.offer pric numeric'),
            'details_ar.required' => __('massages.offer details required ar'),
            'details_en.required' => __('massages.offer details required en'),
        ];
    }
}
