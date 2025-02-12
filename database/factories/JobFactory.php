<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'employer_id' => Employer::factory(),
            'salary' => '$' . fake()->numberBetween(2000, 10000) . 'USD'
        ];
    }
}

/*

Play this with tinker in the terminal

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> App\Models\Job::factory()->create();
= App\Models\Job {#5278
    title: "Precision Printing Worker",
    salary: "$7039USD",
    updated_at: "2025-02-12 03:33:12",
    created_at: "2025-02-12 03:33:12",
    id: 5,
  }

Or you can specify a number of records for the factory to generate fake data

> App\Models\Job::factory(10)->create();

If a foreign key id is connected to other models, it will generate that model too.
Here's the connected model that cause the employer table to be generated too.
$table->foreignIdFor(\App\Models\Employer::class);
  
*/