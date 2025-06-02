<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="flex flex-col items-center mb-2">
                <!-- Logo representativo de campañas de correo -->
                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="3" y="7" width="18" height="10" rx="2" />
                        <path d="M3 7l9 6 9-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <h1 class="text-2xl font-bold text-slate-800">Log in to your account</h1>
                <p class="mt-2 text-sm text-slate-600">Enter your email and password below to log in</p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-sm font-medium text-green-600" :status="session('status')" />

        <form wire:submit="login" class="space-y-4">
            <!-- Email Address -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                <div class="relative">
                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        class="block w-full rounded-lg border border-slate-300 p-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                </div>
                @error('email') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input
                        wire:model="password"
                        id="password"
                        type="password"
                        class="block w-full rounded-lg border border-slate-300 p-2.5 pr-10 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <button type="button" tabindex="-1" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                        onclick="togglePasswordVisibility('password')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @error('password') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <label for="remember" class="ml-2 block text-sm text-slate-700">Remember me</label>
            </div>

            <button type="submit" class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Log in
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center text-sm text-slate-600">
                Don't have an account? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a>
            </div>
        @endif
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>