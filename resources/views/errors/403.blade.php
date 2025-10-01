@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="fas fa-shield-alt fa-5x text-danger"></i>
                    </div>
                    <h1 class="card-title text-danger">403</h1>
                    <h4 class="card-subtitle mb-3 text-muted">Access Denied</h4>
                    <p class="card-text mb-4">
                        Sorry, you don't have permission to access this page.
                        @if(Auth::check())
                            <br><br>
                            <strong>Your Role:</strong> 
                            <span class="badge {{ Auth::user()->isAdmin() ? 'bg-primary' : 'bg-success' }}">
                                {{ Auth::user()->isAdmin() ? 'Admin' : 'Employee' }}
                            </span>
                        @endif
                    </p>
                    
                    <div class="d-flex gap-2 justify-content-center">
                        @if(Auth::check())
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-tachometer-alt me-1"></i>Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('absensi.index') }}" class="btn btn-success">
                                    <i class="fas fa-clock me-1"></i>Go to Attendance
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        @endif
                        
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 10px;
}

.fa-5x {
    font-size: 4rem !important;
}

h1 {
    font-size: 5rem;
    font-weight: bold;
}

.btn {
    border-radius: 25px;
    padding: 8px 20px;
}
</style>
@endsection