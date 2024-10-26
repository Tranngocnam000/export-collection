<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'table_categories';
    protected $id = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'name',
    ];
}
