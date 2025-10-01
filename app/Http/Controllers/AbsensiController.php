<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensis = Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();
        return view('absensi.index', compact('absensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::orderBy('nama')->get();
        return view('absensi.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:hadir,izin,sakit,alpha',
            'keterangan'  => 'nullable|string',
        ]);

        Absensi::create($data);
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $absensi = Absensi::with('karyawan')->findOrFail($id);
        return view('absensi.show', compact('absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Check if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        $absensi = Absensi::findOrFail($id);
        $karyawans = Karyawan::orderBy('nama')->get();
        return view('absensi.edit', compact('absensi', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Check if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        $absensi = Absensi::findOrFail($id);
        
        $data = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal'     => 'required|date',
            'status'      => 'required|in:hadir,izin,sakit,alpha',
            'keterangan'  => 'nullable|string',
        ]);

        $absensi->update($data);
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        
        // Check if there are no more attendance records left
        if (Absensi::count() == 0) {
            // Reset auto-increment to 1
            DB::statement('ALTER TABLE absensis AUTO_INCREMENT = 1');
        }
        
        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus!');
    }
    
    // Method to manually reset auto-increment for attendance
    public function resetAutoIncrement()
    {
        // Only allow if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        // Reset auto-increment to the next available ID
        $maxId = Absensi::max('id') ?? 0;
        $nextId = $maxId + 1;
        DB::statement("ALTER TABLE absensis AUTO_INCREMENT = $nextId");
        
        return redirect()->route('absensi.index')->with('success', 'Auto-increment ID absensi berhasil direset!');
    }
    
    // Method to delete all attendance records and reset ID
    public function deleteAll()
    {
        // Only allow if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        // Delete all attendance records
        Absensi::truncate(); // This will delete all records and reset auto-increment to 1
        
        return redirect()->route('absensi.index')->with('success', 'Semua data absensi berhasil dihapus dan ID direset!');
    }
}
