<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:karyawans',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);

        Karyawan::create($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:karyawans,nik,' . $karyawan->id,
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);

        $karyawan->update($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate!');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        
        // Check if there are no more employees left
        if (Karyawan::count() == 0) {
            // Reset auto-increment to 1
            DB::statement('ALTER TABLE karyawans AUTO_INCREMENT = 1');
        }
        
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
    
    // Method to manually reset auto-increment
    public function resetAutoIncrement()
    {
        // Only allow if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        // Reset auto-increment to the next available ID
        $maxId = Karyawan::max('id') ?? 0;
        $nextId = $maxId + 1;
        DB::statement("ALTER TABLE karyawans AUTO_INCREMENT = $nextId");
        
        return redirect()->route('karyawan.index')->with('success', 'Auto-increment ID berhasil direset!');
    }
    
    // Method to delete all employees and reset ID
    public function deleteAll()
    {
        // Only allow if user is admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access denied. Admin access required.');
        }
        
        // Delete all employees
        Karyawan::truncate(); // This will delete all records and reset auto-increment to 1
        
        return redirect()->route('karyawan.index')->with('success', 'Semua karyawan berhasil dihapus dan ID direset!');
    }
}
