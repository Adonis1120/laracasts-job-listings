<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function user(): BelongsTo {
      return $this->belongsTo(User::class);
    }
}

/*
Play this in the terminal

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> $employer = App\Models\Employer::first();
= App\Models\Employer {#5558
    id: 1,
    name: "Johnson, Schumm and Dietrich",
    created_at: "2025-02-12 06:01:54",
    updated_at: "2025-02-12 06:01:54",
  }

> $employer->jobs;
= Illuminate\Database\Eloquent\Collection {#5206
    all: [
      App\Models\Job {#5204
        id: 1,
        created_at: "2025-02-12 06:01:54",
        updated_at: "2025-02-12 06:01:54",
        employer_id: 1,
        title: "Survey Researcher",
        salary: "$9439USD",
      },
    ],
  }

> $employer->jobs->first()->title;
= "Survey Researcher"

*/
