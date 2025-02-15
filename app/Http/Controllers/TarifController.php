<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarif.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Jenis_Plg' => 'required|unique:tarifs,Jenis_Plg',
            'BiayaBeban' => 'required|numeric',
            'TarifKWH' => 'required|numeric',
        ]);
        $validatedData = $request->only(['Jenis_Plg', 'BiayaBeban', 'TarifKWH']);


        Tarif::create($request->all());

        return redirect()->route('tarif.index')->with('success', 'Jenis Pelanggan berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarif)
    {
        return view('tarif.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'Jenis_Plg' => 'required|unique:tarifs,Jenis_Plg,' . $tarif->id,
            'BiayaBeban' => 'required|numeric',
            'TarifKWH' => 'required|numeric',
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarif.index')->with('success', 'Jenis Pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('tarif.index')->with('success','Jenis Pelanggan Berhasil Dihapus');
    }
}
