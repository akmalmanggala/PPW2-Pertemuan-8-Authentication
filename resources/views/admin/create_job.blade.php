<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tambah Lowongan - Admin</title>
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
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.jobs') }}" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Tambah Lowongan Baru</h2>
                        <p class="text-sm text-gray-600">Isi form di bawah untuk menambahkan lowongan pekerjaan</p>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Form Card -->
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6">
                            <!-- Notifikasi error -->
                            @if ($errors->any())
                                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                    <p class="font-semibold mb-2">Terdapat beberapa kesalahan:</p>
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.jobs.store') }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <!-- Job Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Lowongan <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="title"
                                        type="text"
                                        name="title"
                                        value="{{ old('title') }}"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        placeholder="Contoh: Full Stack Developer"
                                    />
                                </div>

                                <!-- Company -->
                                <div>
                                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Perusahaan <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="company"
                                        type="text"
                                        name="company"
                                        value="{{ old('company') }}"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        placeholder="Contoh: PT Tech Indonesia"
                                    />
                                </div>

                                <!-- Location -->
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="location"
                                        type="text"
                                        name="location"
                                        value="{{ old('location') }}"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        placeholder="Contoh: Jakarta, Indonesia"
                                    />
                                </div>

                                <div>
                                    <label for="job_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Pekerjaan <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        id="job_type"
                                        name="job_type"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    >
                                        <option value="">Pilih Jenis Pekerjaan</option>
                                        <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>
                                            Full Time
                                        </option>
                                        <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>
                                            Part Time
                                        </option>
                                        <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>
                                            Contract
                                        </option>
                                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>
                                            Internship
                                        </option>
                                        <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>
                                            Freelance
                                        </option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Pilih tipe pekerjaan yang sesuai dengan lowongan</p>
                                </div>

                                <!-- Salary -->
                                <div>
                                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">
                                        Gaji (Opsional)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-sm">
                                            Rp
                                        </span>
                                        <input
                                            id="salary"
                                            type="text"
                                            name="salary"
                                            value="{{ old('salary') }}"
                                            class="block w-full rounded-lg border border-gray-300 bg-white pl-10 pr-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                            placeholder="4000000"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        />
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Masukkan angka saja, contoh: 4000000</p>
                                </div>

                                <div>
                                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status Lowongan <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        id="is_active"
                                        name="is_active"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    >
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Lowongan aktif akan ditampilkan kepada pencari kerja</p>
                                </div>

                                <!-- Logo -->
                                <div>
                                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Logo Perusahaan (Opsional)
                                    </label>
                                    <input
                                        id="logo"
                                        type="file"
                                        name="logo"
                                        accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                    />
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau SVG. Maksimal 50MB</p>

                                    <!-- Preview Logo -->
                                    <div id="logoPreview" class="mt-3 hidden">
                                        <img id="logoImage" src="" alt="Preview" class="h-20 w-20 object-contain rounded-lg border border-gray-200 p-2">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi Pekerjaan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="8"
                                        required
                                        class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                        placeholder="Jelaskan detail pekerjaan, tanggung jawab, kualifikasi, dan benefit yang ditawarkan..."
                                    >{{ old('description') }}</textarea>
                                    <p class="mt-1 text-xs text-gray-500">Minimal 50 karakter. Jelaskan secara detail agar menarik minat pelamar.</p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                                    <a
                                        href="{{ route('admin.jobs') }}"
                                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-gray-700 font-medium shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 transition"
                                    >
                                        Batal
                                    </a>
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2.5 text-white font-medium shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/30 active:bg-blue-800 transition"
                                    >
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Lowongan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Tips Membuat Lowongan Menarik</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Gunakan judul yang jelas dan spesifik</li>
                                        <li>Jelaskan tanggung jawab dan kualifikasi secara detail</li>
                                        <li>Cantumkan benefit dan keuntungan bekerja di perusahaan</li>
                                        <li>Upload logo perusahaan untuk meningkatkan kredibilitas</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Preview logo sebelum upload
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoImage').src = e.target.result;
                    document.getElementById('logoPreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
