@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-shield fa-3x text-primary"></i>
                    </div>
                    <h4 class="mb-0">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to System
                    </h4>
                    <p class="text-muted mb-0">Enter your credentials to access</p>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Enter your password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                <i class="fas fa-remember-me me-1"></i>Remember Me
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="demo-credentials">
                                    <small class="text-muted d-block mb-1">
                                        <i class="fas fa-user-shield me-1"></i><strong>Admin Demo</strong>
                                    </small>
                                    <small class="text-muted">
                                        admin@admin.com / admin123
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="demo-credentials">
                                    <small class="text-muted d-block mb-1">
                                        <i class="fas fa-user me-1"></i><strong>Employee Demo</strong>
                                    </small>
                                    <small class="text-muted">
                                        employee@employee.com / employee123
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Handle CSRF token expiry by refreshing the page when form submission fails
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="login"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Add a timestamp to ensure fresh submission
            const timestamp = Date.now();
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'timestamp';
            hiddenInput.value = timestamp;
            form.appendChild(hiddenInput);
        });
    }
    
    // Auto-refresh CSRF token every 30 minutes
    setInterval(function() {
        location.reload();
    }, 30 * 60 * 1000); // 30 minutes
});
</script>
@endsection