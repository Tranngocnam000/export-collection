<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'table_books';
    protected $id = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'name',
        'category_id',
    ];
}
