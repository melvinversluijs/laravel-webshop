<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function it;
use function Pest\Laravel\actingAs;
use function uses;

uses(RefreshDatabase::class);

it('can render the password confirm page', function () {
    actingAs(User::factory()->createOne())
        ->get('/user/confirm-password')
        ->assertStatus(200);
});

it('can confirm a password', function () {
    actingAs(User::factory()->createOne())
        ->post('/user/confirm-password', ['password' => 'password',])
        ->assertRedirect()
        ->assertSessionHasNoErrors();
});

it('can will not confirm an invalid password', function () {
    actingAs(User::factory()->createOne())
        ->post('/user/confirm-password', ['password' => 'wrong-password',])
        ->assertSessionHasErrors();
});
