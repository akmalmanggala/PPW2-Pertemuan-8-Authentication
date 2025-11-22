<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
        <h1 class="text-xl font-bold text-gray-900">Job Portal</h1>
        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-purple-100 text-purple-700 rounded-full">Admin</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition
                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Dashboard
        </a>

        <!-- Kelola Lowongan -->
        <a href="{{ route('admin.jobs') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition
                  {{ request()->routeIs('admin.jobs*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <!-- FIX: tambahkan parameter ry kedua (23.931) -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 13.255A23.931 23.931 0 0 1 12 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2m4 6h.01M5 20h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
            </svg>
            Kelola Lowongan
        </a>

        <!-- Daftar Pelamar -->
        <a href="{{ route('admin.applications') }}"
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition
                  {{ request()->routeIs('admin.applications*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Daftar Pelamar
        </a>

        <!-- Kelola User -->
        <a href="#"
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition text-gray-700 hover:bg-gray-100">
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
