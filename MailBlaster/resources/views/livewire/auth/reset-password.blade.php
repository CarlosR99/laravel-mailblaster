<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Reset password</h1>
            <p class="auth-description">Please enter your new password below</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="auth-session-status" :status="session('status')" />

        <form wire:submit="resetPassword" class="auth-form">
            <!-- Email Address -->
            <div class="auth-input-container">
                <label for="email" class="auth-input-label">Email</label>
                <input
                    wire:model="email"
                    id="email"
                    type="email"
                    class="auth-input"
                    required
                    autocomplete="email"
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
                Reset password
            </button>
        </form>
    </div>
</div>