<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedMail;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Models\User;
use App\Notifications\NewApplicationNotification;
use App\Jobs\SendApplicationMailJob;
use App\Jobs\SendAcceptedMailJob;
use App\Jobs\SendRejectedMailJob;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Application::with(['jobVacancy', 'user'])
            ->latest();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                  ->orWhere('applicant_email', 'like', "%{$search}%")
                  ->orWhereHas('jobVacancy', function($subQuery) use ($search) {
                      $subQuery->where('title', 'like', "%{$search}%")
                               ->orWhere('company', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(15);

        // Count by status
        $pendingCount = Application::where('status', 'pending')->count();
        $acceptedCount = Application::where('status', 'accepted')->count();
        $rejectedCount = Application::where('status', 'rejected')->count();

        return view('admin.applications', compact('applications', 'pendingCount', 'acceptedCount', 'rejectedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($jobId)
    {
        $job = JobVacancy::findOrFail($jobId);

        // Check if user already applied with pending or accepted status
        $hasApplied = Application::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($hasApplied) {
            return redirect()->route('user.jobs.show', $jobId)->with('error', 'Anda sudah melamar di lowongan ini dan lamaran Anda masih diproses atau sudah diterima.');
        }

        // Check if job is still active
        if (!$job->is_active) {
            return redirect()->route('user.jobs.show', $jobId)->with('error', 'Lowongan ini sudah ditutup.');
        }

        return view('user.apply_form', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jobId = request()->route('id');

        // Double check if user already applied (prevent race condition)
        $hasApplied = Application::where('user_id', Auth::id())
            ->where('job_id', $jobId)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($hasApplied) {
            return back()->with('error', 'Anda sudah melamar di lowongan ini dan lamaran Anda masih diproses atau sudah diterima.');
        }

        // Validasi lengkap sesuai migration
        $request->validate([
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Upload file resume
        $resumePath = $request->file('cv')->store('cvs', 'public');
        // Create application dengan field lengkap
        $application = Application::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'cv' => $resumePath,
            'status' => 'pending',
        ]);

        $application->load(['user', 'jobVacancy']);

        // Mail::to(Auth::user()->email)->send(
        //     new JobAppliedMail($application->jobVacancy, Auth::user()
        // ));

        dispatch(new SendApplicationMailJob(
            $application->jobVacancy, Auth::user(), $resumePath
        ));

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewApplicationNotification($application));
        }

        return redirect()->route('user.jobs.show', $jobId)->with('success', 'Lamaran berhasil dikirim! Mohon untuk ditunggu, kami akan segera meninjau lamaran Anda.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $application = Application::findOrFail($id);

        if ($application->status !== 'pending') {
            return back()->with('error', 'Status lamaran sudah final dan tidak bisa diubah.');
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application->update(['status' => $validated['status']]);

        // Kirim email notifikasi sesuai status menggunakan queue
        if ($validated['status'] === 'accepted') {
            dispatch(new SendAcceptedMailJob($application));
        } elseif ($validated['status'] === 'rejected') {
            dispatch(new SendRejectedMailJob($application));
        }

        return back()->with('success', 'Status lamaran diperbarui.');
    }

    public function export()
    {
        // Ambil data applications beserta relasinya (user dan job)
        $applications = Application::with(['user', 'jobVacancy'])->get();

        // Persiapkan nama file
        $fileName = 'daftar-pelamar-' . now()->timestamp . '.xlsx';

        // Buat writer untuk stream download
        $writer = SimpleExcelWriter::streamDownload($fileName);

        // Tambahkan header
        $writer->addRow([
            'ID Lamaran',
            'Nama Pelamar',
            'Email Pelamar', // Opsional, jika ada kolom email di model User
            'Lowongan',
            'Status',
            'File CV (Path)',
            'Tanggal Melamar'
        ]);

        // Tambahkan baris data
        foreach ($applications as $app) {
            $writer->addRow([
                'id' => $app->id,
                'nama_pelamar' => $app->user->name ?? 'N/A',
                'email_pelamar' => $app->user->email ?? 'N/A', // Sesuaikan dengan kolom user Anda
                'lowongan' => $app->jobVacancy->title ?? 'N/A',
                'status' => $app->status,
                'cv_path' => $app->cv,
                'tanggal_melamar' => $app->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        // Lakukan download
        return $writer->toBrowser();
    }
}
