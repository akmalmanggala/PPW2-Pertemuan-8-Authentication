<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard - Pencari Kerja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Topbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Title -->
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Job Portal</h1>
                    </div>
                    <div class="hidden md:flex space-x-2">
                        <a href="{{ route('user.dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-sm hover:shadow-md transition">
                            Dashboard
                        </a>
                        <a href="{{ route('user.jobs') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                            Cari Lowongan
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                            Lamaran Saya
                        </a>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Notification -->
                    <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center space-x-3 border-l pl-4">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-full w-10 h-10 flex items-center justify-center shadow-sm">
                            <a href="{{ route('profile.show') }}" class="text-sm font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</a>
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Pencari Kerja</p>
                        </div>
                    </div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-blue-100 mb-6">Temukan lowongan pekerjaan impian Anda hari ini</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('user.jobs') }}" class="inline-flex items-center px-5 py-2.5 bg-white/20 text-white rounded-lg font-medium hover:bg-white/30 transition backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Lowongan
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 border border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-blue-100 rounded-xl p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Lamaran Terkirim</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-xs text-gray-500 mt-2">Bulan ini</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 border border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-yellow-100 rounded-xl p-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Dalam Proses</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-xs text-gray-500 mt-2">Menunggu</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 border border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-green-100 rounded-xl p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Diterima</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-xs text-gray-500 mt-2">Total</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-6 border border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-purple-100 rounded-xl p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 mb-1">Lowongan Disimpan</p>
                <p class="text-3xl font-bold text-gray-900">0</p>
                <p class="text-xs text-gray-500 mt-2">Favorit</p>
            </div>
        </div>

        <!-- Quick Actions & Tips -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Quick Actions -->
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>

                <a href="{{ route('profile.show') }}" class="block bg-white rounded-xl shadow-sm hover:shadow-md transition p-5 border border-gray-100 group">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 mr-4 group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">Kelola Profile</h4>
                            <p class="text-sm text-gray-500">Update informasi pribadi, pengalaman, dan CV Anda</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('user.jobs') }}" class="block bg-white rounded-xl shadow-sm hover:shadow-md transition p-5 border border-gray-100 group">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 mr-4 group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">Cari Lowongan</h4>
                            <p class="text-sm text-gray-500">Temukan pekerjaan yang sesuai dengan skill Anda</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <a href="#" class="block bg-white rounded-xl shadow-sm hover:shadow-md transition p-5 border border-gray-100 group">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 mr-4 group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">Riwayat Lamaran</h4>
                            <p class="text-sm text-gray-500">Lihat status semua lamaran yang telah dikirim</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            </div>

            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl shadow-sm p-6 border border-orange-100">
                <div class="flex items-center mb-4">
                    <div class="bg-orange-500 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Tips Karir</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="bg-orange-500 rounded-full w-2 h-2 mt-1.5 mr-3 flex-shrink-0"></div>
                        <p class="text-sm text-gray-700">Lengkapi profile Anda hingga 100%</p>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-orange-500 rounded-full w-2 h-2 mt-1.5 mr-3 flex-shrink-0"></div>
                        <p class="text-sm text-gray-700">Upload CV yang menarik dan profesional</p>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-orange-500 rounded-full w-2 h-2 mt-1.5 mr-3 flex-shrink-0"></div>
                        <p class="text-sm text-gray-700">Aktif mencari lowongan setiap hari</p>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-orange-500 rounded-full w-2 h-2 mt-1.5 mr-3 flex-shrink-0"></div>
                        <p class="text-sm text-gray-700">Sesuaikan CV dengan posisi yang dilamar</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lowongan Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Lowongan Terbaru Untukmu</h3>
                    <p class="text-sm text-gray-500 mt-1">Rekomendasi berdasarkan profile Anda</p>
                </div>
                <a href="{{ route('user.jobs') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat Semua →</a>
            </div>
            <div class="p-6">
                @if($latestJobs->count() > 0)
                            <div class="space-y-4">
                                @foreach($latestJobs as $job)
                                <a href="{{ route('user.jobs.show', $job->id) }}">
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
                                                {{ Str::limit(strip_tags($job->description), 170) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada lowongan</h3>
                                <p class="mt-2 text-sm text-gray-500">Saat ini tidak ada lowongan terbaru yang tersedia.</p>
                            </div>
                        @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="text-center">
                <p class="text-sm text-gray-500">&copy; 2024 Job Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
