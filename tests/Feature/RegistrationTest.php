<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Jetstream;
use Symfony\Component\HttpFoundation\Response;

use function it;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function uses;

uses(RefreshDatabase::class);

it('can render the registration page', function () {
    get('/register')
        ->assertStatus(Response::HTTP_OK);
});

it('lets new users register', function () {
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);
    assertAuthenticated();
    $response->assertRedirect('/');
});
