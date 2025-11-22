<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Lowongan - {{ $job->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                <div class="flex items-center">
                    <a href="{{ route('admin.jobs') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Detail Lowongan</h2>
                        <p class="text-sm text-gray-600">Informasi lengkap lowongan pekerjaan</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('⚠️ Yakin ingin menghapus lowongan \"{{ $job->title }}\"?\n\nLogo dan semua data akan dihapus permanen!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-5xl mx-auto space-y-6">
                    <!-- Header Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <!-- Logo -->
                                    @if($job->logo)
                                        <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-20 h-20 rounded-lg object-contain border border-gray-200 bg-white p-2">
                                    @else
                                        <div class="w-20 h-20 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Job Info -->
                                    <div>
                                        <h1 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h1>
                                        <p class="text-lg text-gray-600 mt-1">{{ $job->company }}</p>

                                        <!-- Badges -->
                                        <div class="flex flex-wrap items-center gap-2 mt-3">
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
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div>
                                    @if($job->is_active)
                                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-green-100 text-green-700 rounded-full">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-red-100 text-red-700 rounded-full">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Deskripsi Pekerjaan
                        </h2>
                        <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $job->description }}
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Tambahan
                        </h2>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- ID Lowongan -->
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">ID Lowongan</dt>
                                <dd class="text-base text-gray-900">#{{ $job->id }}</dd>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Tanggal Dibuat</dt>
                                <dd class="text-base text-gray-900">
                                    {{ $job->created_at->format('d F Y, H:i') }}
                                    <span class="text-sm text-gray-500">({{ $job->created_at->diffForHumans() }})</span>
                                </dd>
                            </div>

                            <!-- Terakhir Diupdate -->
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                                <dd class="text-base text-gray-900">
                                    {{ $job->updated_at->format('d F Y, H:i') }}
                                    <span class="text-sm text-gray-500">({{ $job->updated_at->diffForHumans() }})</span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Action Buttons (Mobile Friendly) -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('admin.jobs') }}" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                            <a href="{{ route('admin.jobs.edit', $job->id) }}" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Lowongan
                            </a>
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="flex-1" onsubmit="return confirm('⚠️ Yakin ingin menghapus lowongan \"{{ $job->title }}\"?\n\nLogo dan semua data akan dihapus permanen!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Lowongan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
