<?php

namespace Masoudi\Nova;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('masoudi-textlist-field', __DIR__ . '/../dist/js/field.js');
            Nova::style('masoudi-textlist-field', __DIR__ . '/../dist/css/field.css');
        });
    }
}
