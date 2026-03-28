<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkContactFormAsResponded
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if (isset($event->contactForm)) {
            $event->contactForm->update([
                'response_status' => 'responded',
                'responded_at' => now(),
            ]);
        }
    }
}
