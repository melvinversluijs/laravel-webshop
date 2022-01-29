<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function now;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * @return array{
     *      name: string,
     *      email: string,
     *      email_verified_at: Carbon,
     *      password: string,
     *      remember_token: string,
     * }
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory<User>
     */
    public function unverified(): Factory
    {
        return $this->state(static fn (): array => [
            'email_verified_at' => null,
        ]);
    }
}
