@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-plus me-2 text-success"></i>
                        <h5 class="mb-0">Add New Employee</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">
                                        <i class="fas fa-user me-1"></i>Full Name *
                                    </label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama') }}" 
                                           placeholder="Enter employee's full name" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">
                                        <i class="fas fa-id-card me-1"></i>Employee ID (NIK) *
                                    </label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                           id="nik" name="nik" value="{{ old('nik') }}" 
                                           placeholder="Enter unique employee ID" required>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">
                                <i class="fas fa-briefcase me-1"></i>Position/Job Title *
                            </label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                   id="jabatan" name="jabatan" value="{{ old('jabatan') }}" 
                                   placeholder="Enter job position or title" required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Address *
                            </label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" name="alamat" rows="3" 
                                      placeholder="Enter complete address" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Save Employee
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