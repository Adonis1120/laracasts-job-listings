<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            //'admin' => false;
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // For example you have an admin column
    /*
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'admin' => true,
        ]);
    }   // User::factory()->admin()->create()
    */
}

/*

Play this with tinker in the terminal

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> App\Models\User::factory()->create();
= App\Models\User {#5281
    first_name: "Norris",
    last_name: "Moore",
    email: "wgusikowski@example.net",
    email_verified_at: "2025-02-12 03:17:39",
    #password: "$2y$12$uWIoqrklFNu8xwSgsAZzHuJANIJcTd0loG.DMQUV.O9M7S95bTjDq",
    #remember_token: "d0Lrwi2IHR",
    updated_at: "2025-02-12 03:17:39",
    created_at: "2025-02-12 03:17:39",
    id: 1,
  }

  Or you can specify a number of records for the factory to generate fake data

  > App\Models\User::factory(100)->create();

  Or use the unverified() function above

  > App\Models\User::factory()->unverified()->create();

  */