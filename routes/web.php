<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Barryvdh\Debugbar\DataCollector\SessionCollector;

/*
Test Mail Content

Route::get('test', function () {
    return new \App\Mail\JobPosted();
});

Test Mail Delivery: Transfer to JobController store, but with job instance for dynamic email us instance

Route::get('test', function () {
    \Illuminate\Support\Facades\Mail::to('adonisimperial@yahoo.com')->send(
        new \App\Mail\JobPosted()
    );

    return 'Done';
});

Both Test Above: Test in the browser with [lochalhost app_url]/test
*/

Route::get('test', function () {
    // for queue
    //dispatch(function() {
    //    logger('hello from the queue');
    //}); // you can also use delay(5) to delay for 5 seconds

    // for job
    $job = \App\Models\Job::first();
    \App\Jobs\TranslateJob::dispatch($job);

    return 'Done';
});
// Use php artisan queue:work on the terminal to make both jobs and queue work

Route::view('/', 'home');
Route::view('/contact', 'contact');

/*
Route::resource('jobs', JobController::class)->only('index', 'show');
Route::resource('jobs', JobController::class)->except('index', 'show')->middleware('auth');
*/

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');
    //->can('edit-job', 'job'); // using gate (commented at the AppServiceProvider); you can also use ->middleware(['auth', 'can:edit-job,job']);
Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('edit', 'job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit', 'job');

// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');  // give a name when using middleware as the job above
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);