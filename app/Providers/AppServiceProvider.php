<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\TicketCreated;
use App\Listeners\SendTicketToAi;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(
            TicketCreated::class,
            SendTicketToAi::class
        );
    }
}
