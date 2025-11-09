<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cari Lowongan - Job Portal</title>
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
                        <a href="{{ route('user.jobs') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-sm hover:shadow-md transition">
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
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Cari Lowongan Pekerjaan</h2>
                    <p class="text-gray-600 mt-2">Temukan pekerjaan impian Anda dari {{ $jobs->total() }} lowongan tersedia</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Filter -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Search Box -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Pencarian
                    </h3>
                    <form method="GET" action="{{ route('user.jobs') }}" class="space-y-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci</label>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari posisi, perusahaan..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                            />
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                value="{{ request('location') }}"
                                placeholder="Kota, provinsi..."
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                            />
                        </div>

                        <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:shadow-md transition">
                            Cari Sekarang
                        </button>
                    </form>
                </div>

                <!-- Filter Tipe Pekerjaan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </h3>
                    <form method="GET" action="{{ route('user.jobs') }}" class="space-y-3">
                        <!-- Preserve search params -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('location'))
                            <input type="hidden" name="location" value="{{ request('location') }}">
                        @endif

                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700 mb-3">Tipe Pekerjaan</p>

                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="job_type[]" value="full-time" {{ in_array('full-time', request('job_type', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500/20">
                                <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Full Time</span>
                            </label>

                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="job_type[]" value="part-time" {{ in_array('part-time', request('job_type', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500/20">
                                <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Part Time</span>
                            </label>

                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="job_type[]" value="contract" {{ in_array('contract', request('job_type', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500/20">
                                <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Contract</span>
                            </label>

                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="job_type[]" value="internship" {{ in_array('internship', request('job_type', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500/20">
                                <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Internship</span>
                            </label>

                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="job_type[]" value="freelance" {{ in_array('freelance', request('job_type', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500/20">
                                <span class="ml-3 text-sm text-gray-700 group-hover:text-gray-900">Freelance</span>
                            </label>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('user.jobs') }}" class="block text-center w-full px-4 py-2 mt-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                Reset Filter
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Quick Stats -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl shadow-sm p-6 border border-blue-100">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-500 rounded-lg p-2 mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Statistik</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-blue-200">
                            <span class="text-sm text-gray-600">Total Lowongan</span>
                            <span class="text-lg font-bold text-blue-600">{{ $jobs->total() }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-blue-200">
                            <span class="text-sm text-gray-600">Lowongan Aktif</span>
                            <span class="text-lg font-bold text-green-600">{{ $jobs->where('is_active', true)->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-600">Perusahaan</span>
                            <span class="text-lg font-bold text-purple-600">{{ $jobs->unique('company')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="lg:col-span-3">
                <!-- Sort & View Options -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium text-gray-700">Urutkan:</span>
                            <form method="GET" action="{{ route('user.jobs') }}" class="flex items-center space-x-2">
                                <!-- Preserve filters -->
                                @foreach(request()->except('sort') as $key => $value)
                                    @if(is_array($value))
                                        @foreach($value as $v)
                                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach

                                <select name="sort" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Gaji Tertinggi</option>
                                    <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Gaji Terendah</option>
                                </select>
                            </form>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Menampilkan <span class="font-semibold">{{ $jobs->count() }}</span> dari <span class="font-semibold">{{ $jobs->total() }}</span> lowongan</span>
                        </div>
                    </div>
                </div>

                <!-- Job Cards -->
                @if($jobs->count() > 0)
                    <div class="space-y-4">
                        @foreach($jobs as $job)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-200 transition-all duration-300 overflow-hidden group">
                                <div class="p-6">
                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-start flex-1">
                                            <!-- Company Logo -->
                                            @if($job->logo)
                                                <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-16 h-16 rounded-xl object-contain mr-4 border border-gray-200 bg-white p-2 group-hover:scale-105 transition">
                                            @else
                                                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl p-3 mr-4 group-hover:scale-105 transition">
                                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif

                                            <!-- Job Info -->
                                            <div class="flex-1">
                                                <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition">
                                                    {{ $job->title }}
                                                </h3>
                                                <p class="text-gray-600 font-medium mb-3">{{ $job->company }}</p>

                                                <!-- Meta Info -->
                                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                                    <!-- Location -->
                                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium bg-gray-100 text-gray-700 rounded-lg">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        {{ $job->location }}
                                                    </span>

                                                    <!-- Job Type -->
                                                    @if($job->job_type == 'full-time')
                                                        <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-700 rounded-lg">Full Time</span>
                                                    @elseif($job->job_type == 'part-time')
                                                        <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-700 rounded-lg">Part Time</span>
                                                    @elseif($job->job_type == 'contract')
                                                        <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-700 rounded-lg">Contract</span>
                                                    @elseif($job->job_type == 'internship')
                                                        <span class="px-3 py-1 text-sm font-medium bg-purple-100 text-purple-700 rounded-lg">Internship</span>
                                                    @elseif($job->job_type == 'freelance')
                                                        <span class="px-3 py-1 text-sm font-medium bg-pink-100 text-pink-700 rounded-lg">Freelance</span>
                                                    @endif

                                                    <!-- Salary -->
                                                    @if($job->salary)
                                                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium bg-emerald-100 text-emerald-700 rounded-lg">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            {{ format_rupiah($job->salary) }}
                                                        </span>
                                                    @endif

                                                    <!-- Time Posted -->
                                                    <span class="inline-flex items-center px-3 py-1 text-sm text-gray-500">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $job->created_at->diffForHumans() }}
                                                    </span>
                                                </div>

                                                <!-- Description -->
                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                    {{ Str::limit(strip_tags($job->description), 180) }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="ml-4 flex flex-col items-end space-y-2">
                                            @if($job->is_active)
                                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                                                    Tutup
                                                </span>
                                            @endif

                                            <!-- Bookmark Button -->
                                            <button class="p-2 text-gray-400 hover:text-yellow-500 hover:bg-yellow-50 rounded-lg transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Footer Actions -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                0 views
                                            </span>
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                0 applicants
                                            </span>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('user.jobs.show', $job->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                                Lihat Detail
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                            @if($job->is_active)
                                                <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:shadow-md transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                    Lamar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $jobs->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Lowongan Ditemukan</h3>
                        <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                        <a href="{{ route('user.jobs') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Pencarian
                        </a>
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
