<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $job->title }} - Job Portal</title>
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
                        <a href="{{ route('user.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
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
        <!-- Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('user.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('user.jobs') }}" class="hover:text-blue-600 transition">Lowongan</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">Detail Lowongan</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Job Header Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-start flex-1">
                                <!-- Company Logo -->
                                @if($job->logo)
                                    <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-20 h-20 rounded-xl object-contain mr-5 border border-gray-200 bg-white p-2">
                                @else
                                    <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl p-4 mr-5">
                                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Job Title & Company -->
                                <div class="flex-1">
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
                                    <p class="text-xl text-gray-600 font-medium mb-4">{{ $job->company }}</p>

                                    <!-- Meta Badges -->
                                    <div class="flex flex-wrap items-center gap-2">
                                        <!-- Location -->
                                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-100 text-gray-700 rounded-lg">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $job->location }}
                                        </span>

                                        <!-- Job Type -->
                                        @if($job->job_type == 'full-time')
                                            <span class="px-4 py-2 text-sm font-medium bg-blue-100 text-blue-700 rounded-lg">Full Time</span>
                                        @elseif($job->job_type == 'part-time')
                                            <span class="px-4 py-2 text-sm font-medium bg-green-100 text-green-700 rounded-lg">Part Time</span>
                                        @elseif($job->job_type == 'contract')
                                            <span class="px-4 py-2 text-sm font-medium bg-yellow-100 text-yellow-700 rounded-lg">Contract</span>
                                        @elseif($job->job_type == 'internship')
                                            <span class="px-4 py-2 text-sm font-medium bg-purple-100 text-purple-700 rounded-lg">Internship</span>
                                        @elseif($job->job_type == 'freelance')
                                            <span class="px-4 py-2 text-sm font-medium bg-pink-100 text-pink-700 rounded-lg">Freelance</span>
                                        @endif

                                        <!-- Salary -->
                                        @if($job->salary)
                                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-emerald-100 text-emerald-700 rounded-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ format_rupiah($job->salary) }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-100 text-gray-700 rounded-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Negotiable
                                            </span>
                                        @endif

                                        <!-- Posted Date -->
                                        <span class="inline-flex items-center px-4 py-2 text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Posted {{ $job->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="ml-4">
                                @if($job->is_active)
                                    <span class="px-4 py-2 text-sm font-semibold bg-green-100 text-green-700 rounded-full">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-4 py-2 text-sm font-semibold bg-red-100 text-red-700 rounded-full">
                                        Tutup
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if($job->is_active)
                            <div class="flex items-center space-x-3 pt-6 border-t border-gray-200">
                                <button class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Lamar Sekarang
                                </button>
                                <button class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                </button>
                                <button class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="pt-6 border-t border-gray-200">
                                <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center">
                                    <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-red-800 font-medium">Lowongan ini sudah ditutup dan tidak menerima lamaran baru.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Job Description -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 rounded-xl p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Deskripsi Pekerjaan</h2>
                    </div>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- Back Button -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('user.jobs') }}" class="inline-flex items-center px-5 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Lowongan
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Company Info Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Tentang Perusahaan
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Nama Perusahaan</p>
                            <p class="text-gray-900 font-semibold">{{ $job->company }}</p>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-500 mb-1">Lokasi</p>
                            <p class="text-gray-900 font-semibold">{{ $job->location }}</p>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-500 mb-1">Tipe Pekerjaan</p>
                            <p class="text-gray-900 font-semibold">
                                @if($job->job_type == 'full-time') Full Time
                                @elseif($job->job_type == 'part-time') Part Time
                                @elseif($job->job_type == 'contract') Contract
                                @elseif($job->job_type == 'internship') Internship
                                @elseif($job->job_type == 'freelance') Freelance
                                @endif
                            </p>
                        </div>

                        @if($job->salary)
                            <div class="pt-4 border-t border-gray-200">
                                <p class="text-sm font-medium text-gray-500 mb-1">Estimasi Gaji</p>
                                <p class="text-gray-900 font-semibold text-lg">{{ format_rupiah($job->salary) }}</p>
                                <p class="text-xs text-gray-500 mt-1">per bulan</p>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-500 mb-1">Diposting</p>
                            <p class="text-gray-900 font-semibold">{{ $job->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>


                <!-- Tips Card -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl shadow-sm p-6 border border-orange-100">
                    <div class="flex items-center mb-4">
                        <div class="bg-orange-500 rounded-lg p-2 mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Tips Melamar</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-orange-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Pastikan CV Anda up-to-date
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-orange-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Tulis cover letter yang menarik
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-orange-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Sesuaikan dengan job description
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-orange-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Riset tentang perusahaan
                        </li>
                    </ul>
                </div>
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
