<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
            "lastname" => ['required', 'alpha'],
            "name" => ['required', 'alpha'],
            "dni" => ['required', 'numeric'],

            "phones" => ['required'],
            "phones.*.area_code" => ['required', 'numeric'],
            "phones.*.number" => ['required', 'numeric'],
            "phones.*_has_whatsapp" => ['nullable'],

            "address" => ['required'],
            "address.neighborhood" => ['required'],
            "address.street" => ['required'],
            "address.number" => ['required', 'numeric'],
            "address.indications" => ['required'],
            "address.details" => ['required'],
            "address.lat" => ['nullable'],
            "address.lon" => ['nullable'],
            "house_photo" => ['nullable'],

            "product_id" => ['required', 'numeric'],
            "color" => ['required', 'alpha'],
            "is_reproduction" => ['nullable'],
            "delivery" => ['required', 'numeric'],
            "deliver_date" => ['required', 'date'],
            "quotas" => ['required', 'numeric'],
            "payment_description" => ['nullable'],
            "due_date" => ['required'],
            "hour" => ['nullable'],
        ];
    }
}
