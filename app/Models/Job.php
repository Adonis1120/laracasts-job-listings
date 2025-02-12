<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Class Job extends Model {
    use HasFactory;
    protected $table = "job_listings";

    protected $fillable = ["title", "salary"];
}

/*
Play this in the terminal

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> $name = "affkdfj"
= "affkdfj"

> App\Models\Job::find(4);
= App\Models\Job {#5209
    id: 4,
    created_at: "2025-02-12 02:34:23",
    updated_at: "2025-02-12 02:34:23",
    title: "ACME Director",
    salary: "$50,000",
  }

> $job = App\Models\Job::find(4)
= App\Models\Job {#5229
    id: 4,
    created_at: "2025-02-12 02:34:23",
    updated_at: "2025-02-12 02:34:23",
    title: "ACME Director",
    salary: "$50,000",
  }

> $job->title;
= "ACME Director"

> $job->delete();
= true

*/