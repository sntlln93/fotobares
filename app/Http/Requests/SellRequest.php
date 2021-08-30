<?php

namespace App\Http\Requests;

use App\Rules\Name;
use App\Rules\AreaCode;
use App\Rules\PhoneNumber;
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
            "lastname" => ['required', new Name],
            "name" => ['required', new Name],
            "dni" => ['required', 'numeric'],

            "phones" => ['required'],
            "phones.*.area_code" => ['required', new AreaCode],
            "phones.*.number" => ['required', new PhoneNumber],
            "phones.*_has_whatsapp" => ['nullable'],

            "address" => ['required'],
            "address.neighborhood" => ['required'],
            "address.street" => ['required'],
            "address.number" => ['nullable', 'numeric'],
            "address.indications" => ['nullable'],
            "address.details" => ['nullable'],
            "address.lat" => ['nullable'],
            "address.lon" => ['nullable'],
            "house_photo" => ['nullable'],

            "description" => ['nullable'],
            "product_id" => ['required', 'numeric'],
            "color" => ['required', 'alpha'],
            "is_reproduction" => ['nullable'],
            "deliver_date" => ['required', 'date'],
            "quota_id" => ['required'],
            "payment_description" => ['nullable'],
            "hour" => ['nullable'],

            "presale_id" => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            "lastname" => 'apellido',
            "name" => 'nombre',

            "phones" => 'telefonos',
            "phones.*.area_code" => 'característica',
            "phones.*.number" => 'número',

            "address" => 'dirección',
            "address.neighborhood" => 'barrio',
            "address.street" => 'calle',
            "address.number" => 'número o altura',
            "address.indications" => 'indicaciones',
            "address.details" => 'detalles de la casa',
            "address.lat" => 'latitud',
            "address.lon" => 'longitud',
            "house_photo" => 'foto de la casa',

            "product_id" => 'producto',
            "is_reproduction" => 'es reproducción',
            "deliver_date" => 'fecha de entrega',
            "quota_id" => 'cantidad de cuotas',
            "payment_description" => 'descripción del pago',
            "due_date" => 'fecha de pago',
            "hour" => 'hora de visitas',
        ];
    }
}
