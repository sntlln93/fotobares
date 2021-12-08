<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostponePaymentRequest extends FormRequest
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
            'due_date' => ['required', 'date'],
            'hour' => ['nullable'],
            'update_deliver_on' => ['nullable', 'boolean'],
            'update_following_payments' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'update_deliver_on' => $this->has('update_deliver_on') ?? false,
            'update_following_payments' => $this->has('update_following_payments') ?? false,
        ]);
    }
}
