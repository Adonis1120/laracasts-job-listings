<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function jobs() {
        return $this->belongsToMany(Job::class, relatedPivotKey: "job_listing_id"); // explicitly assigning the job_listing_id because we manually assigned its table to job_listings for jobs where laravel automatically recognized it as job_id instead of job_listing_id
      }
}
