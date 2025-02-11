<?php

namespace App\Models;
use Illuminate\Support\Arr;

Class Job {
    public static function all(): array {
        return [
            [
                "id" => 1,
                "title" => "Director",
                "salary" => "$20,000"
            ],
            [
                "id" => 2,
                "title" => "Software Developer",
                "salary" => "$15,000"
            ],
            [
                "id" => 3,
                "title" => "Web Developer",
                "salary" => "$10,000"
            ],
            [
                "id" => 4,
                "title" => "Mobile App Developer",
                "salary" => "$11,000"
            ],
            [
                "id" => 5,
                "title" => "Game Developer",
                "salary" => "$10,500"
            ]
        ];
    }

    public static function find(int $id): array {
        $job = Arr::first(static::all(), fn($job) => $job["id"] == $id);
        /*
        $job = Arr::first($jobs, function ($job) use ($id) {
            return $job["id"] == $id;
        });
        */

        if (!$job) {
            abort(404);
        }

        return $job;
    }
}