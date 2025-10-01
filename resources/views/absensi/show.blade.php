@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-eye me-2 text-info"></i>
                        <span class="h5 mb-0">Attendance Details</span>
                    </div>
                    <div>
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        @endif
                        <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-hashtag me-1 text-muted"></i>ID
                                </label>
                                <div class="info-value">
                                    <span class="badge bg-light text-dark fs-6">{{ $absensi->id }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt me-1 text-muted"></i>Date
                                </label>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($absensi->tanggal)->format('l, d F Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-user me-1 text-muted"></i>Employee Name
                                </label>
                                <div class="info-value">
                                    <strong>{{ $absensi->karyawan->nama }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-id-card me-1 text-muted"></i>Employee ID
                                </label>
                                <div class="info-value">
                                    {{ $absensi->karyawan->nik }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-info-circle me-1 text-muted"></i>Status
                                </label>
                                <div class="info-value">
                                    @php
                                        $statusColors = [
                                            'hadir' => 'success',
                                            'izin' => 'warning',
                                            'sakit' => 'info',
                                            'alpha' => 'danger'
                                        ];
                                        $statusIcons = [
                                            'hadir' => 'check-circle',
                                            'izin' => 'exclamation-circle',
                                            'sakit' => 'plus-circle',
                                            'alpha' => 'times-circle'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$absensi->status] }} fs-6">
                                        <i class="fas fa-{{ $statusIcons[$absensi->status] }} me-1"></i>
                                        {{ ucfirst($absensi->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-1 text-muted"></i>Employee Email
                                </label>
                                <div class="info-value">
                                    {{ $absensi->karyawan->email }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="info-item">
                                <label class="form-label">
                                    <i class="fas fa-comment me-1 text-muted"></i>Notes
                                </label>
                                <div class="info-value">
                                    @if($absensi->keterangan)
                                        <div class="bg-light p-3 rounded">
                                            {{ $absensi->keterangan }}
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">No notes provided</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(Auth::user()->isAdmin())
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Attendance
                            </a>
                            <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                    <i class="fas fa-trash me-2"></i>Delete Attendance
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    margin-bottom: 1rem;
}

.info-item .form-label {
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.info-value {
    font-size: 1rem;
    color: #212529;
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection