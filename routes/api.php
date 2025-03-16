<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\MetaController;

Route::get('/blog',[BlogController::class,'AllBlog']);
Route::get('/blog/{id}',[BlogController::class,'getBlogById']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/seo/{page_name}', [MetaController::class, 'getSeoData']);
