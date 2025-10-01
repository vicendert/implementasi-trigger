@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-clipboard-list me-2 text-primary"></i>
                <span class="h5 mb-0">Attendance Records</span>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('absensi.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle me-2"></i>Add Attendance
                </a>
                @if(Auth::user()->isAdmin() && $absensis->count() > 0)
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tools me-1"></i>Manage IDs
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ route('absensi.reset-auto-increment') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item" 
                                        onclick="return confirm('Reset auto-increment ID for attendance? This will set the next ID based on current highest ID.')">
                                    <i class="fas fa-redo me-2"></i>Reset Auto-Increment
                                </button>
                            </form>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('absensi.delete-all') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" 
                                        onclick="return confirm('Are you sure you want to delete ALL attendance records? This action cannot be undone and will reset IDs to start from 1.')">
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
                When you delete the last attendance record, the ID will automatically reset to 1. 
                You can also manually reset auto-increment or delete all attendance records using the "Manage IDs" dropdown.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if($absensis->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                <th><i class="fas fa-user me-1"></i>Employee</th>
                                <th><i class="fas fa-calendar me-1"></i>Date</th>
                                <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                <th><i class="fas fa-comment me-1"></i>Notes</th>
                                <th class="text-center"><i class="fas fa-cogs me-1"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absensis as $absensi)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $absensi->id }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $absensi->karyawan->nama }}</strong><br>
                                            <small class="text-muted">{{ $absensi->karyawan->nik }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                    {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'hadir' => 'success',
                                            'izin' => 'info', 
                                            'sakit' => 'warning',
                                            'alpha' => 'danger'
                                        ];
                                        $statusIcons = [
                                            'hadir' => 'check-circle',
                                            'izin' => 'info-circle',
                                            'sakit' => 'exclamation-circle', 
                                            'alpha' => 'times-circle'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$absensi->status] }}">
                                        <i class="fas fa-{{ $statusIcons[$absensi->status] }} me-1"></i>
                                        {{ ucfirst($absensi->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($absensi->keterangan)
                                        <span class="text-muted">{{ Str::limit($absensi->keterangan, 30) }}</span>
                                    @else
                                        <span class="text-muted fst-italic">No notes</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- Show button for everyone -->
                                        <a href="{{ route('absensi.show', $absensi->id) }}" 
                                           class="btn btn-info btn-sm" title="View Attendance">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Edit and Delete buttons only for admin -->
                                        @if(Auth::user()->isAdmin())
                                        <a href="{{ route('absensi.edit', $absensi->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit Attendance">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('absensi.destroy', $absensi->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    title="Delete Attendance"
                                                    onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No Attendance Records</h5>
                    <p class="text-muted">Start by recording the first attendance.</p>
                    <a href="{{ route('absensi.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle me-2"></i>Add First Attendance
                    </a>
                </div>
            @endif
        </div>
        @if($absensis->count() > 0)
        <div class="card-footer bg-light">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Total: {{ $absensis->count() }} attendance record(s)
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="fas fa-calendar-day me-1"></i>
                        Today: {{ $absensis->where('tanggal', today()->format('Y-m-d'))->count() }} record(s)
                    </small>
                </div>
            </div>
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
