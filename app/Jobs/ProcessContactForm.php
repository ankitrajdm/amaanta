<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessContactForm implements ShouldQueue
{
    use Queueable;

    public $contactForm;

    /**
     * Create a new job instance.
     */
    public function __construct($contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send email to admin
        \Illuminate\Support\Facades\Mail::to('gm.amaanta@gmail.com')->send(new \App\Mail\ContactFormSubmitted($this->contactForm));

        // Send confirmation email to user
        \Illuminate\Support\Facades\Mail::to($this->contactForm->email)->send(new \App\Mail\ContactFormConfirmation($this->contactForm));

        // Fire event
        event(new \App\Events\ContactFormEmailSent($this->contactForm));

        // Log the processing
        \Illuminate\Support\Facades\Log::info('Contact form processed', [
            'id' => $this->contactForm->id,
            'name' => $this->contactForm->name,
            'email' => $this->contactForm->email,
        ]);
    }
}
