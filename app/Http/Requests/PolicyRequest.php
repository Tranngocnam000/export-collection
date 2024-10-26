<?php

namespace App\Http\Requests;

use App\Http\Helper\ApiCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;

class PolicyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'max:255',
            'code' => 'max:20',
            'valid_from' => 'date',
            'value' => 'numeric',
            'unit_value' => 'max:3'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = RB::error(
            ApiCode::INVALID_DATA_SENT_ON_ADD_ITEM, 
            null, $errors->messages());

        throw new HttpResponseException($response);
    }
}
