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
            "name" => "required|min:1",
           "description" => "required|string|min:1|max:255",
           "price" => "required|integer|min:1",
           "duration" => "required|string|min:1",
           "num_meals" => "required|integer|min:1",
       ];

    }
    public function messages()
    {
      return [
            'name.required'=>"اسم  الخطة مطلوب",
            'description.required'=>"وصف  مطلوب",
            'price.required'=>"السعر مطلوب",
            'duration.required'=>" مدة الخطة مطلوب",
            'num_meals.required'=>" عدد الوجبات مطلوب",
        ];

    }
}
