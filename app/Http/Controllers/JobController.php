<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

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
