<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;

class FrontendController extends Controller
{
    public function cari(Request $request)
    {
        // Validasi input nomor kontrol, bulan, dan tahun
        $request->validate([
            'nokontrol' => 'nullable|string',  // No Kontrol boleh kosong
            'bulan' => 'nullable|integer|between:1,12',  // Bulan valid antara 1 hingga 12
            'tahun' => 'nullable|integer|min:2020|max:' . date('Y'),  // Tahun valid dari 2020 sampai tahun berjalan
        ]);

        // Ambil data pemakaian berdasarkan No Kontrol jika ada
        $pemakaians = Pemakaian::query();

        // Filter berdasarkan No Kontrol
        if ($request->has('nokontrol') && $request->nokontrol != '') {
            $pemakaians->where('NoKontrol', 'like', '%' . $request->nokontrol . '%');
        }

        // Filter berdasarkan Bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $pemakaians->where('Bulan', $request->bulan);
        }

        // Filter berdasarkan Tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $pemakaians->where('Tahun', $request->tahun);
        }

        // Ambil hasil pencarian
        $pemakaians = $pemakaians->get();

        // Kirim data ke view
        return view('welcome', compact('pemakaians'));
    }
}
