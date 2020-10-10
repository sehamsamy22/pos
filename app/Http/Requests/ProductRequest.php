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

        ];

    }
    public function messages()
    {
      return [
           'ar_name.required'=>"الإسم باللغه العربية مطلوب",
          'en_name.required'=>"الإسم باللغه الانجليزية مطلوب",
          'unit.required'=>"الوحدة مطلوبة",
        ];


    }
}
