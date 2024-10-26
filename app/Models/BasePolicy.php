<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasePolicy extends Policy
{
    protected $table = 'policies';
    protected $fillable = [
        'code','name', 'description', 'type', 'value', 
        'valid_from', 'valid_to', 'value', 'color', 'unit_value'
    ];

    protected $attributes = [
        'type' => self::TYPE_BASE,
        'color' => 'blue'
    ];
    protected $hidden =['reference_policy_id', 'valid_to','created_at','updated_at'];
    use HasFactory;
}
