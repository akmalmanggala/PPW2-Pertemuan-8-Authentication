    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-xl rounded-2xl p-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Masuk ke Akun</h2>

                <!-- Notifikasi error -->
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Notifikasi sukses -->
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="/login" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            placeholder="••••••••"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-white font-medium shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/30 active:bg-blue-800 transition"
                    >
                        Login
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="/register" class="font-medium text-blue-600 hover:text-blue-700">Daftar di sini</a>.
                </p>
            </div>
        </div>
    </body>
    </html>
