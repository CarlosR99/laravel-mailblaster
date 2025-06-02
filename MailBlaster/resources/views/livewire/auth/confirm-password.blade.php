<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Confirm password</h1>
            <p class="auth-description">This is a secure area of the application. Please confirm your password before continuing.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="auth-session-status" :status="session('status')" />

        <form wire:submit="confirmPassword" class="auth-form">
            <!-- Password -->
            <div class="auth-input-container">
                <label for="password" class="auth-input-label">Password</label>
                <input
                    wire:model="password"
                    id="password"
                    type="password"
                    class="auth-input"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                @error('password') <span class="auth-error-message">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="auth-button">
                Confirm
            </button>
        </form>
    </div>
</div>