<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;

class FrontendController extends Controller
{
    public function cari(Request $request)
    {
        $request->validate([
            'nokontrol' => 'nullable|string',  
            'bulan' => 'nullable|integer|between:1,12',  // Bulan valid antara 1 hingga 12
            'tahun' => 'nullable|integer|min:2020|max:' . date('Y'),  // Tahun valid dari 2020 sampai tahun berjalan
        ]);

        $pemakaians = Pemakaian::query();

        if ($request->has('nokontrol') && $request->nokontrol != '') {
            $pemakaians->where('NoKontrol', 'like', '%' . $request->nokontrol . '%');
        }

        if ($request->has('bulan') && $request->bulan != '') {
            $pemakaians->where('Bulan', $request->bulan);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $pemakaians->where('Tahun', $request->tahun);
        }

        $pemakaians = $pemakaians->get();

        return view('welcome', compact('pemakaians'));
    }
}
