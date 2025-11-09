<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kelola Lowongan - Admin</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.jobs') }}" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg">
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
                    <h2 class="text-xl font-semibold text-gray-900">Kelola Lowongan Pekerjaan</h2>
                    <p class="text-sm text-gray-600">Tambah, edit, dan hapus lowongan pekerjaan</p>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Notifikasi sukses -->
                @if (session('success'))
                    <div id="successAlert" class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 flex items-center justify-between transition-all duration-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="closeAlert()" class="text-emerald-700 hover:text-emerald-900 ml-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Filter & Search -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <a href="{{ route('admin.jobs.create') }}" class="inline-flex ml-auto items-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/30 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Lowongan
                        </a>
                    </div>

                    <!-- Form Filter & Search -->
                    <form method="GET" action="{{ route('admin.jobs') }}" class="space-y-4" id="filterForm">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <!-- Search Input -->
                            <div class="flex-1">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari berdasarkan judul, perusahaan, lokasi..."
                                        class="block w-full pl-10 pr-3 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    />
                                </div>
                            </div>

                            <!-- Filter Container -->
                            <div class="flex gap-2">
                                <!-- Filter Status -->
                                <select
                                    name="status"
                                    onchange="document.getElementById('filterForm').submit()"
                                    class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                >
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Active Filters Info -->
                        @if(request()->has('search') || request()->has('status') || request()->has('job_type'))
                            <div class="flex items-center gap-2 pt-3 border-t border-gray-200">
                                <span class="text-sm text-gray-600">Filter aktif:</span>

                                @if(request('search'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        Pencarian: "{{ request('search') }}"
                                        <a href="{{ route('admin.jobs', array_filter(request()->except('search'))) }}" class="ml-1.5 text-blue-700 hover:text-blue-900">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </span>
                                @endif

                                @if(request('status') !== null && request('status') !== '')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Status: {{ request('status') == '1' ? 'Aktif' : 'Tidak Aktif' }}
                                        <a href="{{ route('admin.jobs', array_filter(request()->except('status'))) }}" class="ml-1.5 text-green-700 hover:text-green-900">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </span>
                                @endif

                                @if(request('job_type'))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                        Tipe: {{ ucfirst(str_replace('-', ' ', request('job_type'))) }}
                                        <a href="{{ route('admin.jobs', array_filter(request()->except('job_type'))) }}" class="ml-1.5 text-purple-700 hover:text-purple-900">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Jobs Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    @if($jobs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Posisi
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Perusahaan
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Lokasi
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gaji
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($jobs as $job)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    @if($job->logo)
                                                        <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="h-10 w-10 rounded-lg object-contain mr-3 border border-gray-200">
                                                    @else
                                                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $job->title }}</div>
                                                        <div class="text-sm text-gray-500">{{ Str::limit($job->description, 50) }}</div>
                                                        <div class="flex items-center mt-1 space-x-2">
                                                            @if($job->job_type == 'full-time')
                                                                <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-700 rounded">Full Time</span>
                                                            @elseif($job->job_type == 'part-time')
                                                                <span class="px-2 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded">Part Time</span>
                                                            @elseif($job->job_type == 'contract')
                                                                <span class="px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-700 rounded">Contract</span>
                                                            @elseif($job->job_type == 'internship')
                                                                <span class="px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 rounded">Internship</span>
                                                            @elseif($job->job_type == 'freelance')
                                                                <span class="px-2 py-0.5 text-xs font-medium bg-pink-100 text-pink-700 rounded">Freelance</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $job->company }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $job->location }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ format_rupiah($job->salary) ?? 'Tidak disebutkan' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($job->is_active)
                                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                                        Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $job->created_at->format('d M Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-3">
                                                    <a href="{{ route('admin.jobs.show', $job->id) }}" class="text-green-600 hover:text-green-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-blue-600 hover:text-blue-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $jobs->firstItem() }}</span>
                                    sampai
                                    <span class="font-medium">{{ $jobs->lastItem() }}</span>
                                    dari
                                    <span class="font-medium">{{ $jobs->total() }}</span>
                                    hasil
                                </div>
                                <div class="flex space-x-2">
                                    {{ $jobs->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada lowongan</h3>
                            <p class="mt-2 text-sm text-gray-500">Mulai dengan menambahkan lowongan pekerjaan pertama Anda</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // Auto hide success alert setelah 5 detik
        window.addEventListener('DOMContentLoaded', (event) => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                // Fade out setelah 5 detik
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';

                    // Hapus elemen setelah animasi selesai
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            }
        });

        // Fungsi untuk menutup alert manual
        function closeAlert() {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }
    </script>
</body>
</html>
