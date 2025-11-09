<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboardUser(){

        $latestJobs = JobVacancy::latest()->take(5)->where('is_active', true)->get();

        return view('user.dashboard', compact('latestJobs'));
    }

    public function dashboardAdmin()
    {
        // ✅ Ambil data statistik dari database
        $totalJobs = JobVacancy::count();
        $activeJobs = JobVacancy::where('is_active', true)->count();
        $totalUsers = User::where('role', 'user')->count();
        $totalApplicants = 0; // Nanti dari tabel applications

        // ✅ Ambil 5 lowongan terbaru
        $latestJobs = JobVacancy::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalJobs',
            'activeJobs',
            'totalUsers',
            'totalApplicants',
            'latestJobs'
        ));
    }
}
