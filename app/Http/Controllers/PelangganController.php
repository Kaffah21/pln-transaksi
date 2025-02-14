<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NoKontrol' => 'required|unique:pelanggans',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Telepon' => 'required',
            'Jenis_Plg' => 'required|exists:tarifs,Jenis_Plg',
        ]);
        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success','Pelanggan Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan, $NoKontrol)
    {
        $pelanggans = Pelanggan::findOrFail($NoKontrol);
        return view('pelanggan.show', compact('pelanggans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan, $NoKontrol)
    {
        $pelanggans = Pelanggan::findOrFail($NoKontrol);
        return view('pelanggan.edit', compact('pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $NoKontrol)
    {
        $request->validate([
            'Nama' => 'required',
            'Alamat' => 'required',
            'Telepon' => 'required',
            'Jenis_Plg' => 'required',
        ]);

        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success','Jenis Pelanggan Berhasil Dihapus');
    }
}
