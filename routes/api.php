<?php

use App\Http\Controllers\BasePolicyController;
use App\Http\Controllers\ControllerBook;
use App\Http\Controllers\ControllerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', ControllerCategory::class);
Route::apiResource('books', ControllerBook::class);
