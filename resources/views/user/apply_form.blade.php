<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lamar Pekerjaan - {{ $job->title }}</title>
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
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-full w-10 h-10 flex items-center justify-center shadow-sm">
                            <span class="text-sm font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Pencari Kerja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto px-4" data-flash>
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
                <a href="{{ route('user.jobs.show', $job->id) }}" class="hover:text-blue-600 transition">{{ $job->title }}</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">Lamar Pekerjaan</span>
            </div>
        </div>

        <!-- Job Info Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex items-start">
                @if($job->logo)
                    <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-16 h-16 rounded-xl object-contain mr-4 border border-gray-200 bg-white p-2">
                @else
                    <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl p-3 mr-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $job->title }}</h2>
                    <p class="text-lg text-gray-600 font-medium mb-3">{{ $job->company }}</p>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            {{ $job->location }}
                        </span>
                        @if($job->salary)
                            <span class="inline-flex items-center px-3 py-1 text-sm bg-emerald-100 text-emerald-700 rounded-lg font-medium">
                                {{ format_rupiah($job->salary) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <div class="flex items-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Form Lamaran Kerja</h2>
                        <p class="text-blue-100 mt-1">Lengkapi data di bawah untuk melamar pekerjaan ini</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <form method="POST" action="{{ route('user.jobs.apply', ['id' => $job->id]) }}" enctype="multipart/form-data" class="p-8">
                @csrf
                <input type="hidden" name="job_vacancy_id" value="{{ $job->id }}">

                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-red-800 mb-1">Terdapat kesalahan pada form:</h3>
                                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="applicant_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="applicant_name"
                            id="applicant_name"
                            value="{{ old('applicant_name', Auth::user()->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('applicant_name') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap Anda"
                            required>
                        @error('applicant_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="applicant_email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                            name="applicant_email"
                            id="applicant_email"
                            value="{{ old('applicant_email', Auth::user()->email) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('applicant_email') border-red-500 @enderror"
                            placeholder="email@example.com"
                            required>
                        @error('applicant_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload CV/Resume -->
                    <div>
                        <label for="cv" class="block text-sm font-semibold text-gray-700 mb-2">
                            CV/Resume <span class="text-red-500">*</span>
                        </label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 hover:border-blue-500 transition @error('cv') border-red-500 @enderror">
                            <input type="file"
                                   name="cv"
                                   id="cv"
                                   accept=".pdf,.doc,.docx"
                                   class="hidden"
                                   onchange="updateFileName(this)"
                                   required>
                            <label for="cv" class="cursor-pointer block">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-semibold text-blue-600">Klik untuk upload</span> atau drag and drop
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">PDF, DOC, DOCX (Max. 2MB)</p>
                                    <p id="file-name" class="mt-2 text-sm font-medium text-gray-700"></p>
                                </div>
                            </label>
                        </div>
                        @error('cv')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Informasi Penting:</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-700">
                                    <li>Pastikan CV Anda memuat informasi lengkap dan terkini</li>
                                    <li>Anda akan menerima notifikasi via email setelah melamar</li>
                                    <li>Proses review lamaran membutuhkan waktu 3-7 hari kerja</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                        <button type="submit"
                                class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Lamaran
                        </button>
                        <a href="{{ route('user.jobs.show', $job->id) }}"
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
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

    <!-- JavaScript -->
    <script>
        // Update file name display
        function updateFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameDisplay = document.getElementById('file-name');
            if (fileName) {
                fileNameDisplay.textContent = '✓ ' + fileName;
                fileNameDisplay.classList.add('text-green-600');
            }
        }

        // Character counter for cover letter
        const coverLetter = document.getElementById('cover_letter');
        const charCount = document.getElementById('char-count');

        coverLetter.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = length + ' / 5000';

            if (length > 5000) {
                charCount.classList.add('text-red-600', 'font-semibold');
            } else {
                charCount.classList.remove('text-red-600', 'font-semibold');
            }
        });

        // Form confirmation - Prevent double submit
        let isSubmitting = false;
        document.querySelector('form').addEventListener('submit', function(e) {
            // ✅ Prevent double submit
            if (isSubmitting) {
                e.preventDefault();
                return;
            }

            const cv = document.getElementById('cv').files[0];
            if (!cv) {
                e.preventDefault();
                alert('Mohon upload CV/Resume Anda');
                return;
            }

            // Show loading state
            isSubmitting = true;
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...';
        });
    </script>
</body>
</html>
