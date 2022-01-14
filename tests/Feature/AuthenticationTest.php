<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

use function it;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function uses;

uses(RefreshDatabase::class);

it('can render login page', function () {
    get('/login')->assertStatus(Response::HTTP_OK);
});

it('lets users authenticate using the login page', function () {
    $user = User::factory()->createOne();
    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

it('does not authenticate users with an invalid password', function () {
    $user = User::factory()->createOne();
    post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    assertGuest();
});

it('does not let guests access the dashboard', function () {
    get('/')
        ->assertStatus(Response::HTTP_FOUND)
        ->assertRedirect('/login');
});

it('lets authenticated users access the dashboard', function () {
    actingAs(User::factory()->createOne());
    get('/')->assertStatus(Response::HTTP_OK);
});
