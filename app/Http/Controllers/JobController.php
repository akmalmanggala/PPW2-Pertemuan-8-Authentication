<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request){
        $query = JobVacancy::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('company', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $jobs = $query->latest()->paginate(10);
        return view('admin.jobs', compact('jobs'));
    }

    public function show($id){
        $job = JobVacancy::findOrFail($id);
        return view('admin.job_detail', compact('job'));
    }

    public function create(){
        return view('admin.create_job');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:51200',
            'salary' => 'nullable|integer',
            'job_type' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        JobVacancy::create($validated);

        return redirect()->route('admin.jobs')->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function edit($id){
        $job = JobVacancy::findOrFail($id);
        return view('admin.edit_job', compact('job'));
    }

    public function update(Request $request, $id){
        $job = JobVacancy::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:51200',
            'salary' => 'nullable|integer',
            'job_type' => 'nullable|string|max:100',
            'is_active' => 'required|boolean',
        ]);


        if ($request->hasFile('logo')) {
            if ($job->logo && Storage::disk('public')->exists($job->logo)) {
                Storage::disk('public')->delete($job->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $job->update($validated);

        return redirect()->route('admin.jobs')->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy($id){
        $job = JobVacancy::findOrFail($id);

        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->route('admin.jobs')->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }
}
