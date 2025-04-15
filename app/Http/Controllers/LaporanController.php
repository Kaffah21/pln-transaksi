<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemakaian::join('pelanggans', 'pemakaians.NoKontrol', '=', 'pelanggans.NoKontrol')
            ->select('pemakaians.*', 'pelanggans.Nama', 'pelanggans.Alamat', 'pelanggans.Telepon')
            ->where('pemakaians.Status', 'Lunas'); // Pastikan Status dalam tabel sesuai

        if ($request->has('no_kontrol') && !empty($request->no_kontrol)) {
            $query->where('pemakaians.NoKontrol', trim($request->no_kontrol));
        }

        $pemakaians = $query->paginate('5'); // Eksekusi query untuk mendapatkan hasil

        return view('laporan.list', compact('pemakaians'));
    }

}
