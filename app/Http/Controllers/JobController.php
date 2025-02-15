<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
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
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    
    public function edit(Job $job)
    {
        /* This part was moved/defined at the AppServiceProvider
        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
        */

        Gate::authorize('edit-job', $job);  // you can also use Gate::allows or Gate::denies

        /*
        Alternative for the Gate above
        if (Auth::guest()) {
            return redirect('/login');
        }

        if ($job->employer->user->isNot(Auth::user())) {   // $model->is() determines if two models have the same ID and belong to the same table
            abort(403);
        }
        */

        /*
        Using can()
        if (Auth::user()->cannot('edit-job', $job)) {
            abort(403);
        }
        */

        return view('jobs.edit', ['job' => $job]);
    }
    
    public function update(Request $request, Job $job)
    {
        // authorize (on hold)

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        
        return redirect('/jobs/' . $job->id);
    }
    
    public function destroy(Job $job)
    {
        // authorize (on hold)

        $job->delete();
        
        return redirect('/jobs');
    }
}
