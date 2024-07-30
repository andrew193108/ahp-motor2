<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        return view('alternatives.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'harga_motor' => 'required|numeric',
            'konsumsi_bbm' => 'required|numeric',
            'biaya_maintenance' => 'required|numeric',
            'dimensi_motor' => 'required|string|max:255',
            'kapasitas_mesin' => 'required|integer',
        ]);

        Alternative::create($request->all());

        return redirect()->route('alternatives.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alternative = Alternative::findOrFail($id);
        return view('alternatives.create', compact('alternative'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'harga_motor' => 'required|numeric',
            'konsumsi_bbm' => 'required|integer',
            'biaya_maintenance' => 'required|numeric',
            'dimensi_motor' => 'required|integer',
            'kapasitas_mesin' => 'required|integer',
        ]);

        $alternative = Alternative::findOrFail($id);
        $alternative->update($request->all());

        return redirect()->route('alternatives.index')->with('success', 'Alternatif berhasil diupdate.');
    } 
}
