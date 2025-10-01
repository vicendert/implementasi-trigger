@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Absensi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Karyawan</label>
                <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                        id="karyawan_id" name="karyawan_id" required>
                    <option value="">Pilih Karyawan</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" 
                            {{ old('karyawan_id', $absensi->karyawan_id) == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }} - {{ $karyawan->nik }}
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                       id="tanggal" name="tanggal" value="{{ old('tanggal', $absensi->tanggal) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="hadir" {{ old('status', $absensi->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status', $absensi->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status', $absensi->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ old('status', $absensi->status) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                          id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $absensi->keterangan) }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection