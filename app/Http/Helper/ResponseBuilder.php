<?php
namespace App\Http\Helper;

use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\BaseApiCodes;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as ResponseBuilderResponseBuilder;

class ResponseBuilder extends ResponseBuilderResponseBuilder {
    public static function asCreateSuccess($data){
        return self::asSuccess()
        ->withData($data)
        ->withHttpCode(Response::HTTP_CREATED)->build();
    }

    public static function asUpdateSuccess($data){
        return self::asSuccess()
        ->withData($data)
        ->withHttpCode(Response::HTTP_NO_CONTENT)->build();
    }

    public static function asUpdateFailure($data){
        return self::asSuccess()
        ->withData($data)
        ->withHttpCode(Response::HTTP_NO_CONTENT)->build();
    }

    public static function asNotFoundError(){
        return self::asError(Response::HTTP_NOT_FOUND)
            ->withHttpCode(BaseApiCodes::EX_HTTP_NOT_FOUND())
            ->build();
    }
}