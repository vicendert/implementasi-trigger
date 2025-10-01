@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle me-2 text-success"></i>
                        <h5 class="mb-0">Add Attendance Record</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="karyawan_id" class="form-label">
                                        <i class="fas fa-user me-1"></i>Select Employee *
                                    </label>
                                    <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                                            id="karyawan_id" name="karyawan_id" required>
                                        <option value="">Choose an employee...</option>
                                        @foreach($karyawans as $karyawan)
                                            <option value="{{ $karyawan->id }}" 
                                                {{ old('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                                                {{ $karyawan->nama }} - {{ $karyawan->nik }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('karyawan_id')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">
                                        <i class="fas fa-calendar me-1"></i>Date *
                                    </label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle me-1"></i>Attendance Status *
                            </label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" 
                                               id="status_hadir" value="hadir" 
                                               {{ old('status') == 'hadir' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="status_hadir">
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Present
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" 
                                               id="status_izin" value="izin" 
                                               {{ old('status') == 'izin' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="status_izin">
                                            <span class="badge bg-info">
                                                <i class="fas fa-info-circle me-1"></i>Permission
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" 
                                               id="status_sakit" value="sakit" 
                                               {{ old('status') == 'sakit' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="status_sakit">
                                            <span class="badge bg-warning">
                                                <i class="fas fa-exclamation-circle me-1"></i>Sick
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" 
                                               id="status_alpha" value="alpha" 
                                               {{ old('status') == 'alpha' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="status_alpha">
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Absent
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('status')
                                <div class="text-danger mt-1">
                                    <small><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label">
                                <i class="fas fa-comment me-1"></i>Notes/Comments
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" name="keterangan" rows="3" 
                                      placeholder="Add any additional notes or comments (optional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Save Attendance
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Fields marked with * are required.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection