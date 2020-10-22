<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        return  [

            "name" => "required|string|min:1|max:255",
            "email" => "required|email|min:1|max:255|unique:users,email,",
            "phone" => "required|numeric|unique:users",
            'password' => 'required|string|max:191',
            'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ];


    }
        public function messages()
        {

            return [
                'name.required' => "الإسم مطلوب",
                'phone.required' => "رقم الهاتف مطلوب",
                'phone.numeric' => "الجوال يجب ان يكون ارقام",
                'phone.unique' => "هذ الرقم مسجل من قبل",
                'email.required' => "البريد الإلكتروني مسجل من قبل",
                'email.unique' => "الإيميل مسجل من قبل",
                'password.required' => "كلمة المرور مطلوبة",
                'password.confirmed' => "تأكيد كلمة المرور غير مطابقة",
                'image.image' => "الصورة مطلوبة",

            ];




    }
}
