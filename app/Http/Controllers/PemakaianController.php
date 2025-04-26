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

        $pemakaians = $query->orderBy('created_at','desc')->paginate(10);

        return view('pemakaian.index', compact('pemakaians'));
    }


    public function getMeterAwal(Request $request)
    {
        $noKontrol = $request->NoKontrol;
        $tahun = $request->Tahun;
        $bulan = $request->Bulan;
    
        if ($bulan == 1) {
            $bulan = 12;
            $tahun -= 1;
        } else {
            $bulan -= 1;
        }
    
        $previous = Pemakaian::where('NoKontrol', $noKontrol)
            ->where('Tahun', $tahun)
            ->where('Bulan', $bulan)
            ->first();
    
        return response()->json([
            'meter_akhir' => $previous ? $previous->MeterAkhir : 0
        ]);
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
    ]);

    // 🔒 Validasi bulan dan tahun tidak boleh duplikat
    $existing = Pemakaian::where('NoKontrol', $request->NoKontrol)
        ->where('Tahun', $request->Tahun)
        ->where('Bulan', $request->Bulan)
        ->first();

    if ($existing) {
        return back()->withErrors(['Bulan' => 'Data pemakaian untuk bulan dan tahun ini sudah ada.'])->withInput();
    }

    $pelanggan = Pelanggan::where('NoKontrol', $request->NoKontrol)->first();
    $tarif = Tarif::where('Jenis_Plg', $pelanggan->Jenis_Plg)->first();
    $jumlahPakai = $request->MeterAkhir - $request->MeterAwal;
    $biayaBeban = $tarif->BiayaBeban;
    $biayaPemakaian = $jumlahPakai * $tarif->TarifKWH;

    Pemakaian::create([
        'Tahun' => $request->Tahun,
        'Bulan' => $request->Bulan,
        'NoKontrol' => $request->NoKontrol,
        'MeterAwal' => $request->MeterAwal,
        'MeterAkhir' => $request->MeterAkhir,
        'JumlahPakai' => $jumlahPakai,
        'BiayaBebanPemakai' => $biayaBeban,
        'BiayaPemakaian' => $biayaPemakaian,
    ]);

    return redirect()->route('pemakaian.index')->with('success', 'Pemakaian berhasil disimpan');
}

    
    public function getTarif($noKontrol)
{
    $pelanggan = Pelanggan::where('NoKontrol', $noKontrol)->first();

    if ($pelanggan) {
        $tarif = Tarif::where('Jenis_Plg', $pelanggan->Jenis_Plg)->first();
        return response()->json([
            'biaya_beban' => $tarif->BiayaBeban ?? 0
        ]);
    }

    return response()->json(['biaya_beban' => 0]);
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
            'NoKontrol' => 'required',
            'Tahun' => 'required|integer',
            'Bulan' => 'required|integer',
            'MeterAwal' => 'required|numeric',
            'MeterAkhir' => 'required|numeric|gte:MeterAwal',
            'BiayaBebanPemakai' => 'required|numeric',
        ]);
    
        $jumlahPakai = $request->MeterAkhir - $request->MeterAwal;
        $biayaPemakaian = $jumlahPakai * $request->BiayaBebanPemakai;
    
        $pemakaian = Pemakaian::findOrFail($id);
        $pemakaian->update([
            'NoKontrol' => $request->NoKontrol,
            'Tahun' => $request->Tahun,
            'Bulan' => $request->Bulan,
            'MeterAwal' => $request->MeterAwal,
            'MeterAkhir' => $request->MeterAkhir,
            'JumlahPakai' => $jumlahPakai,
            'BiayaBebanPemakai' => $request->BiayaBebanPemakai,
            'BiayaPemakaian' => $biayaPemakaian,
        ]);
    
        return redirect()->route('pemakaian.index')->with('success', 'Data pemakaian berhasil diperbarui.');
    }
    

    public function updateStatus(Pemakaian $pemakaian)
    {
        if ($pemakaian->status !== 'Lunas') {
            $tunggakan = Pemakaian::where('NoKontrol', $pemakaian->NoKontrol)
                ->where(function ($query) use ($pemakaian) {
                    $query->where('Tahun', '<', $pemakaian->Tahun)
                          ->orWhere(function ($q) use ($pemakaian) {
                              $q->where('Tahun', $pemakaian->Tahun)
                                ->where('Bulan', '<', $pemakaian->Bulan);
                          });
                })
                ->where('Status', '!=', 'Lunas')
                ->exists();
    
            if ($tunggakan) {
                return redirect()->route('pemakaian.index')->with('error', 'Anda memiliki tunggakan listrik bulan sebelumnya.');
            }
        }
    
        // Toggle status
        $pemakaian->status = $pemakaian->status === 'Lunas' ? 'Belum Lunas' : 'Lunas';
        $pemakaian->save();
    
        return redirect()->route('pemakaian.index')->with('status', 'Status berhasil diupdate');
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

    public function prosesPembayaran(Request $request)
{
    $no_kontrol = $request->input('no_kontrol');

    Pemakaian::where('NoKontrol', $no_kontrol)
        ->where('Status', '!=', 'Lunas')
        ->update(['Status' => 'Lunas']);

    return redirect()->route('pemakaian.index')->with('status', 'Tagihan berhasil dibayar.');
}

 public function pembayaran(Request $request)
    {
        $no_kontrol = $request->query('no_kontrol');
    
        if (!$no_kontrol) {
            return redirect()->route('pemakaian.index')->with('error', 'No Kontrol tidak ditemukan.');
        }
    
        $tagihan = \App\Models\Pemakaian::where('NoKontrol', $no_kontrol)
            ->where('Status', '!=', 'Lunas')
            ->orderByDesc('Tahun')
            ->orderByDesc('Bulan')
            ->get();
    
        return view('pemakaian.pembayaran', compact('tagihan', 'no_kontrol'));
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
