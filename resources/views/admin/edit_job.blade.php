<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Lowongan - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        @include('admin.layouts.sidebar')

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
                        <h2 class="text-xl font-semibold text-gray-900">Edit Lowongan</h2>
                        <p class="text-sm text-gray-600">Isi form di bawah untuk mengedit lowongan pekerjaan</p>
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

                            <form method="POST" action="{{ route('admin.jobs.update', $job->id) }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Job Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Lowongan <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        id="title"
                                        type="text"
                                        name="title"
                                        value="{{ old('title', $job->title) }}"
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
                                        value="{{ old('company', $job->company) }}"
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
                                        value="{{ old('location', $job->location) }}"
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
                                        <option value="full-time" {{ old('job_type', $job->job_type) == 'full-time' ? 'selected' : '' }}>
                                            Full Time
                                        </option>
                                        <option value="part-time" {{ old('job_type', $job->job_type) == 'part-time' ? 'selected' : '' }}>
                                            Part Time
                                        </option>
                                        <option value="contract" {{ old('job_type', $job->job_type) == 'contract' ? 'selected' : '' }}>
                                            Contract
                                        </option>
                                        <option value="internship" {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>
                                            Internship
                                        </option>
                                        <option value="freelance" {{ old('job_type', $job->job_type) == 'freelance' ? 'selected' : '' }}>
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
                                            value="{{ old('salary', $job->salary) }}"
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
                                        <option value="1" {{ old('is_active', $job->is_active, '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $job->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Lowongan aktif akan ditampilkan kepada pencari kerja</p>
                                </div>

                                <!-- Logo -->
                                <div>
                                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Logo Perusahaan (Opsional)
                                    </label>
                                    @if($job->logo)
                                        <div class="mb-3">
                                            <p class="text-xs text-gray-500 mb-2">Logo saat ini:</p>
                                            <img src="{{ asset('storage/' . $job->logo) }}" alt="Logo {{ $job->company }}" class="h-20 w-20 object-contain rounded-lg border border-gray-200 p-2 bg-white">
                                        </div>
                                    @endif

                                    <input
                                        id="logo"
                                        type="file"
                                        name="logo"
                                        accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                    />
                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, PNG, atau SVG. Maksimal 2MB
                                        @if($job->logo)
                                            <br><span class="text-amber-600">Jika upload logo baru, logo lama akan diganti.</span>
                                        @endif
                                    </p>

                                    <!-- Preview Logo -->
                                    <div id="logoPreview" class="mt-3 hidden">
                                        <p class="text-xs text-gray-500 mb-2">Preview logo baru:</p>
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
                                    >{{ old('description', $job->description) }}</textarea>
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
                                        Simpan Edit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Preview logo baru sebelum upload
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoImage').src = e.target.result;
                    document.getElementById('logoPreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                // Reset preview jika file dihapus
                document.getElementById('logoPreview').classList.add('hidden');
            }
        });
    </script>
</body>
</html>
