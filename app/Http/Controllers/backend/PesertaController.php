<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\peserta;


use Yajra\DataTables\DataTables;
class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peserta = peserta::orderBy('created_at', 'desc')->get();
        return view('backend.peserta.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:50',
        //     'alamat' => 'required|string|max:500',
        //     'no_hp' => 'required|string|max:20',
        // ]);

        // $peserta = new peserta($validatedData);
        // $peserta->save();

        // return redirect()->route('peserta.index')->with('success', 'Peserta added successfully.');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
        ]);

        // Create a new peserta instance and save it
        peserta::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
        ]);

        $peserta = peserta::findOrFail($id);
        $peserta->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peserta = peserta::findOrFail($id);
        $peserta->delete();

      return redirect()->route('peserta.index')->with('success', 'Peserta deleted successfully.');

    }
}
