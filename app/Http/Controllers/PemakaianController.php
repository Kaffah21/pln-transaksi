<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemakaian;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pemakaian::join('pelanggans', 'pemakaians.NoKontrol', '=', 'pelanggans.NoKontrol')
            ->select('pemakaians.*', 'pelanggans.Nama', 'pelanggans.Alamat', 'pelanggans.Telepon');

        if ($request->has('no_kontrol') && !empty($request->no_kontrol)) {
            $query->where('pemakaians.NoKontrol', trim($request->no_kontrol));
        }

        $pemakaians = $query->paginate(5);

        return view('pemakaian.index', compact('pemakaians'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();

        $biayaBeban = null;
        if (old('NoKontrol')) {
            $pelanggan = Pelanggan::where('NoKontrol', old('NoKontrol'))->first();

            if ($pelanggan) {
                $tarif = Tarif::where('Jenis_Plg', $pelanggan->Jenis_Plg)->first();
                if ($tarif) {
                    $biayaBeban = $tarif->BiayaBeban;
                }
            }
        }

        return view('pemakaian.create', compact('pelanggans', 'biayaBeban'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|string|exists:pelanggans,NoKontrol',
            'MeterAwal' => 'required|integer|min:0',
            'MeterAkhir' => 'required|integer|min:0|gte:MeterAwal',
            'JumlahPakai' => 'required|integer|min:0',
            'BiayaBebanPemakai' => 'required|numeric|min:0',
            'BiayaPemakaian' => 'required|numeric|min:0',
        ]);

        Pemakaian::create($request->all());

        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
        $pelanggans = Pelanggan::all();
        return view('pemakaian.edit', compact('pemakaian', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer|min:1|max:12',
            'NoKontrol' => 'required|string|exists:pelanggans,NoKontrol',
            'MeterAwal' => 'required|integer|min:0',
            'MeterAkhir' => 'required|integer|min:0|gte:MeterAwal',
            'JumlahPakai' => 'required|integer|min:0',
            'BiayaBebanPemakai' => 'required|numeric|min:0',
            'BiayaPemakaian' => 'required|numeric|min:0',
        ]);

        $pemakaian = Pemakaian::findOrFail($id);
        $pemakaian->update($request->all());

        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian berhasil diperbarui');
    }

    public function updateStatus(Pemakaian $pemakaian)
    {
        // Toggle the status between 'Lunas' and 'Belum Lunas'
        $pemakaian->status = $pemakaian->status === 'Lunas' ? 'Belum Lunas' : 'Lunas';
        $pemakaian->save();

        return redirect()->route('pemakaian.index')->with('status', 'Status updated successfully');
    }

    public function getBiayaBeban($noKontrol)
    {
        // Find the customer by NoKontrol
        $pelanggan = Pelanggan::where('NoKontrol', $noKontrol)->first();

        if ($pelanggan) {
            $tarif = Tarif::where('Jenis_Plg', $pelanggan->Jenis_Plg)->first();

            if ($tarif) {
                return response()->json([
                    'biaya_beban' => $tarif->BiayaBeban
                ]);
            } else {
                return response()->json(['biaya_beban' => 0]);
            }
        }

        return response()->json(['biaya_beban' => 0]); // Default if no customer is found
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
        $pemakaian->delete();

        return redirect()->route('pemakaian.index')->with('success', 'Pemakaian berhasil dihapus');
    }
}
