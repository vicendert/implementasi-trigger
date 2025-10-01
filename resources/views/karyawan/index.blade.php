@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-2 text-primary"></i>
                <span class="h5 mb-0">Employee Management</span>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Add New Employee
                </a>
                @if($karyawans->count() > 0)
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tools me-1"></i>Manage IDs
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ route('karyawan.reset-auto-increment') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item" 
                                        onclick="return confirm('Reset auto-increment ID? This will set the next ID based on current highest ID.')">
                                    <i class="fas fa-redo me-2"></i>Reset Auto-Increment
                                </button>
                            </form>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('karyawan.delete-all') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" 
                                        onclick="return confirm('Are you sure you want to delete ALL employees? This action cannot be undone and will reset IDs to start from 1.')">
                                    <i class="fas fa-trash-alt me-2"></i>Delete All & Reset IDs
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if(Auth::user()->isAdmin())
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>ID Management:</strong> 
                When you delete the last employee, the ID will automatically reset to 1. 
                You can also manually reset auto-increment or delete all employees using the "Manage IDs" dropdown.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if($karyawans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                <th><i class="fas fa-user me-1"></i>Name</th>
                                <th><i class="fas fa-id-card me-1"></i>NIK</th>
                                <th><i class="fas fa-briefcase me-1"></i>Position</th>
                                <th><i class="fas fa-map-marker-alt me-1"></i>Address</th>
                                <th class="text-center"><i class="fas fa-cogs me-1"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawans as $karyawan)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $karyawan->id }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <strong>{{ $karyawan->nama }}</strong>
                                    </div>
                                </td>
                                <td><code>{{ $karyawan->nik }}</code></td>
                                <td>
                                    <span class="badge bg-info">{{ $karyawan->jabatan }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($karyawan->alamat, 30) }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('karyawan.edit', $karyawan->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit Employee">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="Delete Employee"
                                                    onclick="return confirm('Are you sure you want to delete this employee?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Employees Found</h5>
                    <p class="text-muted">Start by adding your first employee to the system.</p>
                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Add First Employee
                    </a>
                </div>
            @endif
        </div>
        @if($karyawans->count() > 0)
        <div class="card-footer bg-light">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                Total: {{ $karyawans->count() }} employee(s) registered
            </small>
        </div>
        @endif
    </div>
</div>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 0.875rem;
}
</style>
@endsection
