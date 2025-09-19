<?php

namespace ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('admin.web', \ContactForm\Http\Middleware\AdminWebMiddleware::class);
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'contactform');
    }

    public function register()
    {
        //
    }
}
