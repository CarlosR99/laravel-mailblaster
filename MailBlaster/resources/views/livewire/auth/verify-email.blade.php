<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Verify your email</h1>
            <p class="auth-description">Please verify your email address by clicking on the link we just emailed to you.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="auth-session-status">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="mt-6 space-y-4">
            <button wire:click="sendVerification" class="auth-button">
                Resend verification email
            </button>

            <button wire:click="logout" class="w-full flex justify-center py-2.5 px-4 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                Log out
            </button>
        </div>
    </div>
</div>