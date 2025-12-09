<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use App\Models\Order;


class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Event::listen(Authenticated::class, function ($event) {
            $order = Order::where('user_id', $event->user->id)->latest()->first();
            if ($order && $order->status == 'delivered') {
                session(['review_popup_shown' => true]);
            }
        });
    }
}
