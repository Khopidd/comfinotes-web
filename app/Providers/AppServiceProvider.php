<?php

namespace App\Providers;

use App\Models\User\TransactionModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    public function boot(): void
    {

        View::composer('*', function ($view) {
            $notifications = TransactionModel::with('user.divisi')
                ->where('status', 'pending')
                ->latest()
                ->take(7)
                ->get();
            $view->with('notifications', $notifications);
        });
    }
}
