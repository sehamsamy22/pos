<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSubscriptionRequest extends FormRequest
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
           'client_id' => 'required|nullable|integer|exists:clients,id',
           'subscription_id' => 'required|nullable|integer|exists:subscriptions,id',
           "start" => "required|date",
           "end" => "required|",
       ];

    }
    public function messages()
    {
      return [
            'client_id.required'=>"اسم  العميل مطلوب",
            'subscription_id.required'=>"نوع الاشتراك  مطلوب",
            'start.required'=>"بداية الاشتراك مطلوب",
            'end.required'=>" نهاية الاشتراك الخطة مطلوب",
        ];

    }
}
