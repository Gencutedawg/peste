<x-guest-layout>
    <div class="card-title">Create your account</div>
    <p class="card-subtitle">Register for Peste and start organizing paste items with a secure and polished workflow.</p>

    @if ($errors->any())
        <div class="error-card">
            <strong>There are some problems with your submission.</strong>
            <ul style="margin: .75rem 0 0; padding-left: 1.2rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="first_name" class="form-label">First Name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus autocomplete="given-name" class="form-control" />
            @foreach ($errors->get('first_name') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input id="middle_name" type="text" name="middle_name" value="{{ old('middle_name') }}" autocomplete="additional-name" class="form-control" />
            @foreach ($errors->get('middle_name') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="last_name" class="form-label">Last Name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name" class="form-control" />
            @foreach ($errors->get('last_name') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control" />
            @foreach ($errors->get('email') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-input-group">
                <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control" />
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
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="password-input-group">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control" />
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
            @foreach ($errors->get('password_confirmation') as $message)
                <div class="field-error">{{ $message }}</div>
            @endforeach
        </div>

        <div class="form-actions">
            <a class="secondary-link" href="{{ route('login') }}">Already registered?</a>
            <button type="submit" class="primary-btn">Register</button>
        </div>
    </form>
</x-guest-layout>
