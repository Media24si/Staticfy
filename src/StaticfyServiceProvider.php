<?php

namespace Media24si\Staticfy;

use Illuminate\Support\ServiceProvider;

class StaticfyServiceProvider extends ServiceProvider  {

        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
                $this->publishes([
                        __DIR__.'/../config/staticfy.php' => config_path('staticfy.php'),
                ]);
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
                $this->commands([
                        \Media24si\Staticfy\Console\Generate::class
                ]);
        }

}
