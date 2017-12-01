<?php

namespace App\Providers;

use App\Models\Topic;
use App\Models\User;
use App\Observers\TopicObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(250);
        \Carbon\Carbon::setLocale('zh');
        Topic::observe(new TopicObserver());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
