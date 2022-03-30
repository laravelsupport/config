<?php

namespace LaravelSupport\Config;

use Illuminate\Support\ServiceProvider;

class SocialServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
        
    }
}