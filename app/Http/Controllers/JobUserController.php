<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;

class JobUserController extends Controller
{
    public function index(Request $request)
    {
        // Start query builder
        $query = JobVacancy::query()->where('is_active', true);

        // Search functionality (title, company, description)
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('company', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Location filter
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Job type filter (checkbox multiple)
        if ($request->has('job_type') && is_array($request->job_type) && count($request->job_type) > 0) {
            $query->whereIn('job_type', $request->job_type);
        }

        // Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'salary_high':
                $query->orderBy('salary', 'desc');
                break;
            case 'salary_low':
                $query->orderBy('salary', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        // Paginate results (10 per page)
        $jobs = $query->paginate(10)->appends($request->all());

        return view('user.jobs', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobVacancy::findOrFail($id);

        // Increment view count (optional, jika ada kolom views di database)
        // $job->increment('views');

        return view('user.job_detail', compact('job'));
    }
}
