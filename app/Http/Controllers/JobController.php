<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Gate;
//use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPosted;

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
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->send(   // You can specify ->user->email but Laravel automatically detect it while using Mail class
            new JobPosted($job) // pass the job instance into the constructor of Mailable
        );
    
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

        // This gate was transferred to route through can() function
        //Gate::authorize('edit-job', $job);  // you can also use Gate::allows or Gate::denies

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
        //Gate::authorize('edit-job', $job);

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
        //Gate::authorize('edit-job', $job);

        $job->delete();
        
        return redirect('/jobs');
    }
}
