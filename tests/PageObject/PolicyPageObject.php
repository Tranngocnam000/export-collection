<?php

namespace Tests\PageObject;

use Faker\Factory;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ApiResponse;

use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

class PolicyPageObject {

    protected $submittedData, $data;
    protected $method = 'all';

    private $id, $code, $name, $description, $type, $valid_from, 
        $valid_to, $value, $unit_value, $color;

    protected $response;
    protected $status;
    protected static $instance;


    public function __construct(){

    }

    public static function asA($user = null) : PolicyPageObject{
        // if (!self::$instance) {
            self::$instance = new PolicyPageObject();
        // }
        return self::$instance;
    }

    public function Iwant() : PolicyPageObject {        
        return $this;
    }

    public function all() : PolicyPageObject {
        $this->method = __FUNCTION__;
        return $this;
    }

    public function fetchOne($id = null) : PolicyPageObject {
        $this->id = $id;
        $this->method = __FUNCTION__;
        return $this;
    }

    public function add() : PolicyPageObject {
        $this->method = __FUNCTION__;
        return $this;
    }

    public function edit($id) : PolicyPageObject {
        $this->id = $id;
        $this->method = __FUNCTION__;
        return $this;
    }

    public function withId($id) : PolicyPageObject {
        $this->id = $id;
        return $this;
    }

    public function withCode($code) : PolicyPageObject {
        $this->code = $code;
        $this->submittedData['code'] = $code;
        return $this;
    }

    public function withName($name) : PolicyPageObject {
        $this->name = $name;
        $this->submittedData['name'] = $name;
        return $this;
    }

    public function withDescription($description) : PolicyPageObject {
        $this->description = $description;
        $this->submittedData['description'] = $description;
        return $this;
    }

    public function withType($type) : PolicyPageObject {
        $this->type = $type;
        $this->submittedData['type'] = $type;
        return $this;
    }

    public function withValidFrom($from) : PolicyPageObject {
        $this->valid_from = $from;
        $this->submittedData['valid_from'] = $from;
        return $this;
    }

    public function withValidTo($to) : PolicyPageObject {
        $this->valid_to = $to;
        return $this;
    }

    public function withValue($value) : PolicyPageObject {
        $this->value = $value;
        $this->submittedData['value'] = $value;
        return $this;
    }

    public function withUnitValue($unit) : PolicyPageObject {
        $this->unit_value = $unit;
        $this->submittedData['unit_value'] = $unit;
        return $this;
    }

    public function withColor($color) : PolicyPageObject {
        $this->color = $color;
        $this->submittedData['color'] = $color;
        return $this;
    }

    public function withFakeData(array $policy = []) : PolicyPageObject {

        $faker = Factory::create();
        $name = [
            ['base-pay', 'staff', 'first-line manager', 'middle-manager', 'executive'],
            ['Dever Lv1', 'Dever Lv2', 'TC Lv1', 'PO Lv1', 'PO Lv3'],
        ];
        $currency = ['VND', 'JPY'];
        $type = rand(1,2);

        $this->submittedData = [
            'code' => $this->code = uniqid('PC-'),
            'name' => $this->name = $name[$type - 1][array_rand($name[$type - 1])],
            'description' => $this->description = isset($policy['description']) ? $policy['description'] : $faker->text(),
            'type' => $this->type = $type, 
            'valid_from' => $this->valid_from = '2024-06-01 00:00:00',            
            'value' => $this->value = rand(1000000, 10000000),
            'unit_value' => $this->unit_value = $currency[array_rand($currency)],
            'color' => $this->color = $faker->colorName(),    
        ];

        foreach ($policy as $key => $data){
            if (is_null($policy[$key])){
                unset($this->submittedData[$key]);
            } else {
                $this->submittedData[$key] = $data;
            }
        }

        return $this;
    }

    public function call() : PolicyPageObject {
        switch ($this->method){
            case 'fetchOne':
                $this->response = get('api/policy/'.$this->id);
                break;            
            case 'all':
                $this->response = get('api/policy');                
                break;
            case 'add':
                $this->response = post('api/policy', $this->submittedData);
                break;
            case 'edit':
                $this->response = put('api/policy/'.$this->id, $this->submittedData);
                break;
            default:
            break;
        }

        if ($this->response){     
            try {                
                $this->data = ApiResponse::fromJson($this->response->content());
            } catch (\JsonException $e){
                echo $e->getMessage()."\n";
                echo $this->response->content();                
                return $this;
            }
                        
        }
        
        return $this;
    }

    public function getSubmittedData(){
        return $this->submittedData;
    }

    public function status() {
        return $this->response->status();
    }

    public function responseContent() {
        return $this->response->content();
    }

    public function success() {
        return  $this->data->success();
    }

    public function data(){
        return  $this->data->getData();
    }

    public function items($index = null) : array{
        if (!$this->data->getData()['items']){
            return null;
        }
        if (is_null($index)){
            return $this->data->getData()['items'];
        } 
        
        return $this->data->getData()['items'][$index];
    }

    public function item(){        
        return $this->data->getData()['item'] ? $this->data->getData()['item'] : null;
    }
}