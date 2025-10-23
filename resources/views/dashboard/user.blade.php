<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard - Pencari Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">Job Portal</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700 font-medium">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-white font-medium shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 active:bg-red-800 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Dashboard Pencari Kerja</h2>
            <p class="mt-2 text-gray-600">Temukan lowongan pekerjaan impian Anda</p>
        </div>
    </div>
</body>
</html>
