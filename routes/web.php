<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function() { // Pitfalls: putting this route below the route with wildcard below will not work
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // request()->all
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // authorize (on hold)

    $job = Job::findOrFail($id);

    /*
    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();
    */

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    
    return redirect('/jobs/' . $id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize (on hold)

    Job::findOrFail($id)->delete();
    
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});

/*
Other types of routing (using the show route)
1. Basic Routing
As used above

2. Model Binding
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});

3. Model Binding Specifying the Column
Route::get('/jobs/{job:slug}', function (Job $job) {
    return view('jobs.show', ['job' => $job]);
});

4. Dedicated Controller Classes
Route::get('/jobs/{job}', [JobController::class], 'show');

5. Group Routes
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/{job}', 'show');
    Route::get('/jobs', 'store');
});

6. Route Resource
Route::resource('jobs', JobController::class);

6. Route Resource (using except/only)
Route::resource('jobs', JobController::class, [
    'except' => ['edit', 'delete']
    // 'only' => ['index', 'show']
]);

8. Route View
Route::view('/', 'home');

*/