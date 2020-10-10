<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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

            "code" => "required|min:1",
           "type" => "required|string|min:1|max:255",
           "price" => "required|integer|min:1",
           "num_days" => "required|integer|min:1",
           "reserved_days" => "required|integer|min:1",


       ];

    }
    public function messages()
    {
      return [
            'code.required'=>"الكود مطلوب",
            'type.required'=>"النوع مطلوب",
            'price.required'=>"السعر مطلوب",
            'num_days.required'=>"عدد الايام مطلوب",
            'reserved_days.required'=>"الحصص المحجوزة مطلوب",
        ];


    }
}
