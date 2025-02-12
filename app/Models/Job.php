<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Class Job extends Model {
    use HasFactory;
    protected $table = "job_listings";

    protected $fillable = ["title", "salary"];

    public function employer() {
      return $this->belongsTo(Employer::class);
    }
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

/*
For relationship

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> $job = App\Models\Job::first();
= App\Models\Job {#5221
    id: 1,
    created_at: "2025-02-12 06:01:54",
    updated_at: "2025-02-12 06:01:54",
    employer_id: 1,
    title: "Survey Researcher",
    salary: "$9439USD",
  }

> $job->employer;
= App\Models\Employer {#6238
    id: 1,
    name: "Johnson, Schumm and Dietrich",
    created_at: "2025-02-12 06:01:54",
    updated_at: "2025-02-12 06:01:54",
  }

> $job->employer->name;
= "Johnson, Schumm and Dietrich"
*/