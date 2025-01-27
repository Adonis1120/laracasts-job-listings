<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("home");
});

Route::get("/jobs", function () {
    return view("jobs", [
        "jobs" => [
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
        ]
    ]);
});

Route::get("/jobs/{id}", function ($id) {
    $jobs = [
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

    $job = Arr::first($jobs, fn($job) => $job["id"] == $id);
    /*
    $job = Arr::first($jobs, function ($job) use ($id) {
        return $job["id"] == $id;
    });
    */

    return view('job', ["job" => $job]);
});

Route::get("/contact", function () {
    return view('contact');
});