@extends('layouts.app')

@section('content')
<div class="container fade-in">
    @guest
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <i class="fas fa-user-shield me-2"></i>Welcome
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <h5>Access Required</h5>
                        <p class="text-muted">Please login to access the attendance management system.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="stats-card text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-tie stats-icon me-3"></i>
                        <div>
                            <h3 class="mb-1">Welcome back, {{ Auth::user()->name }}!</h3>
                            <p class="mb-0 opacity-75">{{ date('l, F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5>Total Employees</h5>
                        <h2 class="text-primary">{{ App\Models\Karyawan::count() }}</h2>
                        <p class="text-muted">Registered in system</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h5>Today's Attendance</h5>
                        <h2 class="text-success">{{ App\Models\Absensi::whereDate('tanggal', today())->count() }}</h2>
                        <p class="text-muted">Records for today</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{ route('absensi.index') }}" class="btn btn-primary w-100 py-3">
                                    <i class="fas fa-clipboard-list fa-2x d-block mb-2"></i>
                                    <span>Manage Attendance</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('absensi.create') }}" class="btn btn-success w-100 py-3">
                                    <i class="fas fa-plus-circle fa-2x d-block mb-2"></i>
                                    <span>Add Attendance</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('karyawan.index') }}" class="btn btn-info w-100 py-3">
                                    <i class="fas fa-users fa-2x d-block mb-2"></i>
                                    <span>Manage Employees</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('karyawan.create') }}" class="btn btn-warning w-100 py-3">
                                    <i class="fas fa-user-plus fa-2x d-block mb-2"></i>
                                    <span>Add Employee</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-cog me-2"></i>Account Settings
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('change-password') }}" class="btn btn-outline-warning w-100 py-3">
                                    <i class="fas fa-key fa-2x d-block mb-2"></i>
                                    <span>Change Password</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center py-3">
                                    <i class="fas fa-user-shield fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Secure your account by regularly updating your password</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</div>
@endsection
