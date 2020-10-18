<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            "ar_name" => "required|string|min:1|max:255",
           "en_name" => "required|string|min:1|max:255",
           "unit" => "required|string|min:1|max:255",
           'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
           "price" => "required",

        ];

    }
    public function messages()
    {
      return [
           'ar_name.required'=>"الإسم باللغه العربية مطلوب",
          'en_name.required'=>"الإسم باللغه الانجليزية مطلوب",
          'unit.required'=>"الوحدة مطلوبة",
          'image.required'=>"صورة الصنف مطلوبة",
          'price.required'=>"سعر الصنف مطلوب",
        ];


    }
}
