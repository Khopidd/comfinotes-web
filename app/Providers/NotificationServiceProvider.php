<?php

namespace App\Providers;

use App\Models\User\TransactionModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['admin.dashboard-admin', 'components.sidebar-admin'], function ($view) {
            $notifications = TransactionModel::with('user.divisi')
                ->where('status', 'pending')
                ->latest()
                ->get();

            $view->with('notifications', $notifications);
        });
    }
}
