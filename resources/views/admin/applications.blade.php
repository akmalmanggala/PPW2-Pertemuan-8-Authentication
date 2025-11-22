<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daftar Pelamar - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Daftar Pelamar</h2>
                    <p class="text-sm text-gray-600">Kelola semua lamaran pekerjaan yang masuk</p>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @include('components.flash')
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Total Lamaran -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $applications->total() }}</p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lamaran Pending -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pending</p>
                                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $applications->where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lamaran Accepted -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Diterima</p>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $applications->where('status', 'accepted')->count() }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lamaran Rejected -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Ditolak</p>
                                <p class="text-3xl font-bold text-red-600 mt-2">{{ $applications->where('status', 'rejected')->count() }}</p>
                            </div>
                            <div class="bg-red-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Semua Lamaran</h3>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('applications.export') }}"
                            class="inline-flex items-center px-3 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/>
                                </svg>
                                Export Excel
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        @if($applications->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelamar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lowongan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CV</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($applications as $application)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $application->user->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $application->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $application->jobVacancy->title }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->jobVacancy->location }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $application->jobVacancy->company }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($application->status == 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @elseif($application->status == 'accepted')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Diterima
                                                    </span>
                                                @elseif($application->status == 'rejected')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $application->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if($application->status === 'pending')
                                                    <div class="flex items-center gap-2">
                                                        {{-- Terima --}}
                                                        <form method="POST"
                                                            action="{{ route('applications.update-status', $application->id) }}"  {{-- ganti ke route Anda jika berbeda --}}
                                                            onsubmit="return confirm('Terima lamaran ini?')">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-1.5 rounded-md bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                                </svg>
                                                                Terima
                                                            </button>
                                                        </form>

                                                        {{-- Tolak --}}
                                                        <form method="POST"
                                                            action="{{ route('applications.update-status', $application->id) }}"  {{-- ganti ke route Anda jika berbeda --}}
                                                            onsubmit="return confirm('Tolak lamaran ini?')">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-1.5 rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif($application->status === 'accepted')
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-emerald-50 text-emerald-700">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Diterima
                                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6a2 2 0 114 0v2h3a1 1 0 011 1v9a1 1 0 01-1 1H7a1 1 0 01-1-1V9a1 1 0 011-1h3V6z"/>
                                                        </svg>
                                                    </span>
                                                @elseif($application->status === 'rejected')
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-red-50 text-red-600">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        Ditolak
                                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6a2 2 0 114 0v2h3a1 1 0 011 1v9a1 1 0 01-1 1H7a1 1 0 01-1-1V9a1 1 0 011-1h3V6z"/>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada lamaran</h3>
                                <p class="mt-2 text-sm text-gray-500">Lamaran pekerjaan akan muncul di sini setelah ada yang melamar</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($applications->hasPages())
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Menampilkan {{ $applications->firstItem() }} sampai {{ $applications->lastItem() }} dari {{ $applications->total() }} hasil
                                </div>
                                <div class="flex space-x-1">
                                    @if($applications->onFirstPage())
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md">
                                            Sebelumnya
                                        </span>
                                    @else
                                        <a href="{{ $applications->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            Sebelumnya
                                        </a>
                                    @endif

                                    @foreach($applications->getUrlRange(1, $applications->lastPage()) as $page => $url)
                                        @if($page == $applications->currentPage())
                                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    @if($applications->hasMorePages())
                                        <a href="{{ $applications->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            Selanjutnya
                                        </a>
                                    @else
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md">
                                            Selanjutnya
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Modal for Cover Letter -->
    <div id="coverLetterModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Surat Lamaran</h3>
                    <button onclick="closeCoverLetterModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 px-7 py-3 bg-gray-50 rounded-md">
                    <p id="coverLetterContent" class="text-sm text-gray-700 whitespace-pre-wrap"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCoverLetter(content) {
            document.getElementById('coverLetterContent').textContent = content;
            document.getElementById('coverLetterModal').classList.remove('hidden');
        }

        function closeCoverLetterModal() {
            document.getElementById('coverLetterModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('coverLetterModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCoverLetterModal();
            }
        });
    </script>
</body>
</html>
