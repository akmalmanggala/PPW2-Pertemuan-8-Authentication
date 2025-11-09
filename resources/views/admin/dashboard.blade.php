<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-900">Job Portal</h1>
                <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Admin</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.jobs') }}" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kelola Lowongan
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Kelola User
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center mb-3">
                    <div class="bg-purple-100 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                        <span class="text-sm font-bold text-purple-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Dashboard Admin</h2>
                    <p class="text-sm text-gray-600">Selamat datang di panel admin Job Portal</p>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Total Lowongan -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lowongan</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalJobs }}</p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pelamar -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pelamar</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalApplicants }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lowongan Aktif -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Lowongan Aktif</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeJobs }}</p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total User -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total User</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="bg-purple-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <a href="{{ route('admin.jobs.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white hover:from-blue-600 hover:to-blue-700 transition">
                        <div class="flex items-center">
                            <div class="bg-white/20 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Tambah Lowongan Baru</h3>
                                <p class="text-blue-100 text-sm">Posting lowongan kerja baru</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.jobs') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-sm p-6 text-white hover:from-purple-600 hover:to-purple-700 transition">
                        <div class="flex items-center">
                            <div class="bg-white/20 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Kelola Lowongan</h3>
                                <p class="text-purple-100 text-sm">Edit dan hapus lowongan kerja</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Lowongan Terbaru -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Lowongan Terbaru</h3>
                        <a href="{{ route('admin.jobs') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="p-6">
                        @if($latestJobs->count() > 0)
                            <div class="space-y-4">
                                @foreach($latestJobs as $job)
                                    <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                                        <!-- Header: Logo, Title, Company -->
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-start">
                                                @if($job->logo)
                                                    <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-12 h-12 rounded-lg object-contain mr-4 border border-gray-200 bg-white p-1">
                                                @else
                                                    <div class="bg-blue-100 rounded-lg p-2 mr-4">
                                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900 text-base">{{ $job->title }}</h4>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $job->company }}</p>

                                                    <!-- Location & Job Type Badges -->
                                                    <div class="flex items-center gap-2 mt-2">
                                                        <!-- Location Badge -->
                                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            </svg>
                                                            {{ $job->location }}
                                                        </span>

                                                        <!-- Job Type Badge -->
                                                        @if($job->job_type == 'full-time')
                                                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded">Full Time</span>
                                                        @elseif($job->job_type == 'part-time')
                                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded">Part Time</span>
                                                        @elseif($job->job_type == 'contract')
                                                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded">Contract</span>
                                                        @elseif($job->job_type == 'internship')
                                                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-700 rounded">Internship</span>
                                                        @elseif($job->job_type == 'freelance')
                                                            <span class="px-2 py-1 text-xs font-medium bg-pink-100 text-pink-700 rounded">Freelance</span>
                                                        @endif

                                                        <!-- Salary -->
                                                        @if($job->salary)
                                                            <span class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded">
                                                                {{ format_rupiah($job->salary) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status & Time -->
                                            <div class="flex flex-col items-end space-y-2 ml-4">
                                                @if($job->is_active)
                                                    <span class="px-2.5 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                                        Tidak Aktif
                                                    </span>
                                                @endif
                                                <span class="text-xs text-gray-500">
                                                    {{ $job->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Description Preview -->
                                        <div class="mt-3 pt-3 border-t border-gray-200">
                                            <p class="text-sm text-gray-600 line-clamp-2">
                                                {{ Str::limit(strip_tags($job->description), 150) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada lowongan</h3>
                                <p class="mt-2 text-sm text-gray-500">Mulai dengan menambahkan lowongan pekerjaan pertama</p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tambah Lowongan
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
