<x-guest-layout>
    <div class="card-title">Welcome back</div>
    <p class="card-subtitle">Sign in to your account and continue managing pastes, users, and permissions.</p>

    @if (session('status'))
        <div class="status-card">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-card">
            <strong>Something went wrong.</strong>
            <ul style="margin: .75rem 0 0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="login" class="form-label">Email or Username</label>
            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus autocomplete="username" class="form-control" />
            @foreach ($errors->get('login') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-input-group">
                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control" />
                <button type="button" class="toggle-password-btn" aria-label="Show password">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="icon-open">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="icon-closed">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.93 20.93 0 0 1 5.25-6.33" />
                        <path d="M1 1l22 22" />
                        <path d="M9.88 9.88a3 3 0 0 0 4.24 4.24" />
                        <path d="M14.12 14.12A3 3 0 0 1 9.88 9.88" />
                    </svg>
                </button>
            </div>
            @foreach ($errors->get('password') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label class="checkbox-wrap">
                <input id="remember_me" type="checkbox" name="remember" />
                Remember me
            </label>
        </div>

        <div class="form-actions">
            @if (Route::has('password.request'))
                <a class="secondary-link" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif

            <button type="submit" class="primary-btn">Log in</button>
        </div>
    </form>
</x-guest-layout>
