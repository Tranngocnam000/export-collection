<?php

namespace App\Http\Requests;

use App\Http\Helper\ApiCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;

class BasePolicyPostRequest extends PolicyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rule = parent::rules();
        return [
            'name' => 'required'.'|'.$rule['name'],
            'code' => 'required'.'|'.$rule['code'],
            'valid_from' => 'required'.'|'.$rule['valid_from'],
            'value' => 'required'.'|'.$rule['value'],
            'unit_value' => 'required'.'|'.$rule['unit_value'],
        ];
    }

    public function all($key = null) {
        $input = parent::all($key);
        if (isset($input['valid_from'])){
            $input['valid_from'] = date("Y-m-d 00:00:00", strtotime($input['valid_from']));
        }
        
        return $input;
    }

}
