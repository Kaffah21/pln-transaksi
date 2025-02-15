<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::with('tarif')->get(); // Menampilkan semua pelanggan dengan tarifnya
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        $tarifs = Tarif::all(); // Mengambil semua tarif untuk dropdown jenis_plg
        return view('pelanggan.create', compact('tarifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NoKontrol' => 'required|string|unique:pelanggans',
            'Nama' => 'required|string',
            'Alamat' => 'required|string',
            'Telepon' => 'required|string',
            'Jenis_Plg' => 'required|exists:tarifs,Jenis_Plg', // Validasi jenis_plg harus ada di tabel tarif
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');;
    }

    public function edit($NoKontrol)
    {
        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $tarifs = Tarif::all();  // Menyediakan data jenis pelanggan untuk dropdown
        return view('pelanggan.edit', compact('pelanggan', 'tarifs'));
    }

    public function update(Request $request, $NoKontrol)
    {
        $request->validate([
            'NoKontrol' => 'required|string',
            'Nama' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'Telepon' => 'required|string|max:15',
            'Jenis_Plg' => 'required|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }


    public function destroy($NoKontrol)
    {
        $pelanggan = Pelanggan::findOrFail($NoKontrol);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');;
    }
}
