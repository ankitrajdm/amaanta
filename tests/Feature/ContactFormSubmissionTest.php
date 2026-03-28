<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactFormSubmissionTest extends TestCase
{
    public function test_contact_form_submission()
    {
        $contactData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+1234567890',
            'subject' => 'Test Subject',
            'event_type' => 'Wedding',
            'event_date' => now()->addDays(7)->format('Y-m-d'),
            'guests' => 100,
            'services' => ['Lawn', 'Decoration'],
            'budget' => '$5000 - $10000',
            'message' => 'This is a test message for the contact form.',
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect('/');
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_forms', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'event_type' => 'Wedding',
        ]);
    }

    public function test_contact_form_validation()
    {
        $response = $this->post('/contact', []);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['name', 'email', 'phone', 'subject', 'event_type', 'event_date', 'guests', 'services', 'budget', 'message']);
    }
}
