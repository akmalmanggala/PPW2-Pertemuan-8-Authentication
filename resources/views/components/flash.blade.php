@php
$flashId = 'flash-'.uniqid();
$hasFlash = session()->has('success') || session()->has('error') || $errors->any();
@endphp

@if(session('success'))
    <div id="{{ $flashId }}-success"
         data-flash-shown="true"
         class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 mb-6 transition-all duration-500 ease-in-out overflow-hidden shadow-sm"
         style="max-height: 200px;">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1">{{ session('success') }}</span>
        </div>
    </div>
    <script>
        (function() {
            const el = document.getElementById('{{ $flashId }}-success');
            if (!el) return;

            // Check if already shown in this session
            const shown = sessionStorage.getItem('{{ $flashId }}-success-shown');
            if (shown) {
                el.remove();
                return;
            }

            // Mark as shown
            sessionStorage.setItem('{{ $flashId }}-success-shown', 'true');

            // Auto hide after 4 seconds
            setTimeout(() => {
                el.style.maxHeight = '0';
                el.style.marginBottom = '0';
                el.style.paddingTop = '0';
                el.style.paddingBottom = '0';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }, 4000);
        })();
    </script>
@endif

@if(session('error'))
    <div id="{{ $flashId }}-error"
         data-flash-shown="true"
         class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 mb-6 transition-all duration-500 ease-in-out overflow-hidden shadow-sm"
         style="max-height: 200px;">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1">{{ session('error') }}</span>
        </div>
    </div>
    <script>
        (function() {
            const el = document.getElementById('{{ $flashId }}-error');
            if (!el) return;

            // Check if already shown in this session
            const shown = sessionStorage.getItem('{{ $flashId }}-error-shown');
            if (shown) {
                el.remove();
                return;
            }

            // Mark as shown
            sessionStorage.setItem('{{ $flashId }}-error-shown', 'true');

            // Auto hide after 4 seconds
            setTimeout(() => {
                el.style.maxHeight = '0';
                el.style.marginBottom = '0';
                el.style.paddingTop = '0';
                el.style.paddingBottom = '0';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }, 4000);
        })();
    </script>
@endif

@if ($errors->any())
    <div id="{{ $flashId }}-validation"
         data-flash-shown="true"
         class="rounded-lg bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 mb-6 transition-all duration-500 ease-in-out overflow-hidden shadow-sm"
         style="max-height: 300px;">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <ul class="list-disc pl-5 flex-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        (function() {
            const el = document.getElementById('{{ $flashId }}-validation');
            if (!el) return;

            // Validation errors usually should show again on back
            // So we don't use sessionStorage here

            // Auto hide after 6 seconds
            setTimeout(() => {
                el.style.maxHeight = '0';
                el.style.marginBottom = '0';
                el.style.paddingTop = '0';
                el.style.paddingBottom = '0';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }, 6000);
        })();
    </script>
@endif
