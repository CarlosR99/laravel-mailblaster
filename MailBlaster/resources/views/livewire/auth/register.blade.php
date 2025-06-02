<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Create an account</h1>
            <p class="auth-description">Enter your details below to create your account</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="auth-session-status" :status="session('status')" />

        <form wire:submit="register" class="auth-form">
            <!-- Name -->
            <div class="auth-input-container">
                <label for="name" class="auth-input-label">Full name</label>
                <input
                    wire:model="name"
                    id="name"
                    type="text"
                    class="auth-input"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="John Doe"
                />
                @error('name') <span class="auth-error-message">{{ $message }}</span> @enderror
            </div>

            <!-- Email Address -->
            <div class="auth-input-container">
                <label for="email" class="auth-input-label">Email address</label>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    class="auth-input"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />
                @error('email') <span class="auth-error-message">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="auth-input-container">
                <label for="password" class="auth-input-label">Password</label>
                <input
                    wire:model="password"
                    id="password"
                    type="password"
                    class="auth-input"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                @error('password') <span class="auth-error-message">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="auth-input-container">
                <label for="password_confirmation" class="auth-input-label">Confirm password</label>
                <input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    type="password"
                    class="auth-input"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
            </div>

            <button type="submit" class="auth-button">
                Create account
            </button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}" class="auth-link">Log in</a>
        </div>
    </div>
</div>