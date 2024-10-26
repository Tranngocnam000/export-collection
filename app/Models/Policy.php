<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    public const TYPE_BASE = 1;
    public const TYPE_CONSTANT = 2;
    public const TYPE_RELATION = 3;

    protected $fillable = [
        'code','name', 'description', 'type', 'value', 'reference_policy_id', 
        'valid_from', 'valid_to', 'value', 'color', 'unit_value'
    ];
    
    use HasFactory;
}
