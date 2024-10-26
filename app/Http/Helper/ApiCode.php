<?php
namespace App\Http\Helper;

use MarcinOrlowski\ResponseBuilder\BaseApiCodes;

class ApiCode extends BaseApiCodes
{
    public const FAILURE_ON_ADD_ITEM = 250;
    public const INVALID_DATA_SENT_ON_ADD_ITEM = 250;

    public const MESSAGE_MAP = [
        self::FAILURE_ON_ADD_ITEM => 'salary_management.error.failure_to_add_new_item'
    ];

    public static $instance;

    protected $code=0;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function message(){
        return self::MESSAGE_MAP[$this->code];
    }

    public static function code($code){
        if (!self::$instance){
            self::$instance = new ApiCode($code);
        }        
        return  self::$instance;
    }
}