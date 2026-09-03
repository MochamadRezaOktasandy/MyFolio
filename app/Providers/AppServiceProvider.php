<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagikan data tautan sosial aktif ke seluruh view footer dan layout publik
        View::composer(['components.footer', 'layouts.app'], function ($view) {
            $view->with('globalSocialLinks', SocialLink::where('is_active', true)->orderBy('sort_order')->get());
        });
    }
}
