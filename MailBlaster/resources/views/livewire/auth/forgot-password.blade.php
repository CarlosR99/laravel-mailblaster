<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Forgot password</h1>
            <p class="auth-description">Enter your email to receive a password reset link</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="auth-session-status" :status="session('status')" />

        <form wire:submit="sendPasswordResetLink" class="auth-form">
            <!-- Email Address -->
            <div class="auth-input-container">
                <label for="email" class="auth-input-label">Email address</label>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    class="auth-input"
                    required
                    autofocus
                    placeholder="email@example.com"
                />
                @error('email') <span class="auth-error-message">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="auth-button">
                Email password reset link
            </button>
        </form>

        <div class="auth-footer">
            Or, return to <a href="{{ route('login') }}" class="auth-link">log in</a>
        </div>
    </div>
</div>