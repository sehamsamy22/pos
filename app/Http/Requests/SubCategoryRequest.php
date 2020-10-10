<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'category_id' => 'required|nullable|integer|exists:categories,id',
            "name" => "required|string|min:1|max:255",
            "image" => 'required_without:_method|nullable|image',

        ];
        }
        public function messages()
    {
       return [
            'name.required'=>"الإسم مطلوب",
            'image.image'=>"الصورة مطلوبة",
            'category_id.required'=>" التصنيف الفرعى مطلوب",
        ];



    }
}
