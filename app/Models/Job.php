<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Class Job extends Model {
    use HasFactory;
    protected $table = 'job_listings';

    protected $guarded = []; // Disable the fillable security feature entirely on the model.
    // protected $fillable = ['title', 'salary', 'employer_id'];

    public function employer() {
      return $this->belongsTo(Employer::class);
    }

    public function tags() {
      return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id'); // explicitly assigning the job_listing_id because we manually assigned its table to job_listings for jobs where laravel automatically recognized it as job_id instead of job_listing_id
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

/*
For Pivot Table

php artisan tinker
Psy Shell v0.12.7 (PHP 8.2.4 — cli) by Justin Hileman
> $job = App\Models\Job::find(10)
= App\Models\Job {#5212
    id: 10,
    created_at: "2025-02-12 07:25:47",
    updated_at: "2025-02-12 07:25:47",
    employer_id: 10,
    title: "Precision Aircraft Systems Assemblers",
    salary: "$5492USD",
  }

> $job->tags
= Illuminate\Database\Eloquent\Collection {#6023
    all: [
      App\Models\Tag {#6238
        id: 3,
        created_at: null,
        updated_at: null,
        name: "Aircraft",
        pivot: Illuminate\Database\Eloquent\Relations\Pivot {#5972 
          job_listing_id: 10,
          tag_id: 3,
        },
      },
    ],
  }

> $tag = App\Models\Tag::find(3);
= App\Models\Tag {#6183
    id: 3,
    created_at: null,
    updated_at: null,
    name: "Aircraft",
  }

> $tag->jobs;
= Illuminate\Database\Eloquent\Collection {#5209
    all: [
      App\Models\Job {#5204
        id: 10,
        created_at: "2025-02-12 07:25:47",
        updated_at: "2025-02-12 07:25:47",
        employer_id: 10,
        title: "Precision Aircraft Systems Assemblers",
        salary: "$5492USD",
        pivot: Illuminate\Database\Eloquent\Relations\Pivot {#5206 
          tag_id: 3,
          job_listing_id: 10,
        },
      },
    ],
  }

> $tag->jobs()->attach(App\Models\Job::find(7));
= null

> $tag->jobs()->get()->pluck('title');
= Illuminate\Support\Collection {#5211
    all: [
      "Precision Aircraft Systems Assemblers",
      "General Practitioner",
    ],
  }
*/