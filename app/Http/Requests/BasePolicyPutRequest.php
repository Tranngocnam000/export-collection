<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasePolicyPutRequest extends PolicyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return parent::rules();
    }
}
