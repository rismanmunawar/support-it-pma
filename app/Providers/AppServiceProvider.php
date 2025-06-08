<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = Pengumuman::whereDoesntHave('dibacaOleh', function ($query) {
                    $query->where('user_id', Auth::id());
                })->count();

                $view->with('unreadCount', $unreadCount);
            }
        });
    }
}
