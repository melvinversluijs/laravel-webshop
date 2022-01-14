<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

use function it;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function uses;

uses(RefreshDatabase::class);

it('can render the request reset password link page', function () {
    get('/forgot-password')
        ->assertStatus(Response::HTTP_OK);
});

it('lets the user request a reset password link', function () {
    Notification::fake();
    $user = User::factory()->createOne();
    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class);
});

it('can render the reset password page', function () {
    Notification::fake();
    $user = User::factory()->createOne();
    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification): bool {
        get('/reset-password/' . $notification->token)
            ->assertStatus(Response::HTTP_OK);

        return true;
    });
});

it('can reset a password with a valid token', function () {
    Notification::fake();
    $user = User::factory()->createOne();
    post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo(
        $user,
        ResetPassword::class,
        function (ResetPassword $notification) use ($user): bool {
            post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ])->assertSessionHasNoErrors();

            return true;
        }
    );
});
