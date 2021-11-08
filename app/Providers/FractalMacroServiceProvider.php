<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Fractal\Fractal;

class FractalMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Fractal::macro('success', function ($data) {
            $options = ['message' => '', 'status_code' => 200];
            // transform the passed stats as necessary here
            return $this->addMeta(array_merge($options, $data));
        });
    }
}
