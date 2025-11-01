<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profile - Job Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Topbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Title -->
                <div class="flex items-center space-x-8">
                    <h1 class="text-xl font-bold text-gray-900">Job Portal</h1>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('user.dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                            Dashboard
                        </a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                            Cari Lowongan
                        </a>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 rounded-full w-10 h-10 flex items-center justify-center">
                            <a href="{{ route('profile.show') }}" class="text-sm font-bold text-blue-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</a>
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Profile Saya</h2>
            <p class="mt-2 text-gray-600">Kelola informasi profile Anda</p>
        </div>

        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-8">
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-full p-1">
                        <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center">
                            <span class="text-3xl font-bold text-blue-600">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <div class="text-white">
                        <h3 class="text-2xl font-semibold">{{ Auth::user()->name }}</h3>
                        <p class="text-blue-100">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 px-3 py-1 bg-blue-700 text-xs font-medium rounded-full">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="p-6">
                <!-- Notifikasi error -->
                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', Auth::user()->name) }}"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            placeholder="Nama Lengkap"
                        />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', Auth::user()->email) }}"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            placeholder="email@example.com"
                        />
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Ubah Password</h4>
                        <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>

                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input
                                    id="current_password"
                                    type="password"
                                    name="current_password"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    placeholder="••••••••"
                                />
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    placeholder="••••••••"
                                />
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                    placeholder="••••••••"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2.5 text-white font-medium shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/30 active:bg-blue-800 transition"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Akun</h4>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Terdaftar sejak:</span>
                    <span class="font-medium text-gray-900">{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Terakhir update:</span>
                    <span class="font-medium text-gray-900">{{ Auth::user()->updated_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Role:</span>
                    <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
