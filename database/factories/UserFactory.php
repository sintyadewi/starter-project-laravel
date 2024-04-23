<?php

namespace Database\Factories;

use App\Modules\Membership\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Membership\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $fcmTokens = [
                [
                    'token_id' => Str::random(16),
                    'fcm_token' => env('FCM_TOKEN')
                ],
                [
                    'token_id' => Str::random(16),
                    'fcm_token' => env('FCM_TOKEN_2')
                ],
                [
                    'token_id' => Str::random(16),
                    'fcm_token' => env('FCM_TOKEN_3')
                ],
            ];

            if ($user->id === 2) {
                $user->fcmToken()->createMany($fcmTokens);
            }
        });
    }
}
