<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kas;
use App\Models\peserta;
use App\Exports\KasExport;
use Maatwebsite\Excel\Facades\Excel;
class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = kas::with('peserta');

        // Cek apakah tanggal telah dipilih
        if ($request->has('tanggal')) {
            $tanggal = $request->tanggal;
            $query->whereDate('tanggal_pembayaran', $tanggal);
        }

        $pembayaranKas = $query->get();
        $peserta = peserta::first();
        $pesertaOptions = peserta::pluck('name', 'id');

        return view('backend.kas.index', compact('pembayaranKas', 'peserta', 'pesertaOptions'));
        //return view('backend.kas.index', compact('pembayaranKas'));
    }

    /**
     * Show the form for creating a new resource.
     */

//      public function export()
// {
//     return Excel::download(new KasExport, 'kas.xlsx');
// }

public function export()
{
    return Excel::download(new KasExport, 'kas.csv');
}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => 'required|exists:peserta,id',
        ]);

        // Cek apakah peserta sudah membayar pada hari ini
        $hariIni = now()->format('Y-m-d');
        $pesertaId = $request->peserta_id;
        $peserta = peserta::findOrFail($pesertaId);
        $pembayaranHariIni = kas::where('peserta_id', $pesertaId)
            ->whereDate('tanggal_pembayaran', $hariIni)
            ->count();

        if ($pembayaranHariIni > 0) {
            return redirect()->route('kas.index')->with('error', 'Peserta sudah membayar pada hari ini.');
        }


        kas::create([
            'peserta_id' => $pesertaId,
            'tanggal_pembayaran' => now(),
            'jumlah_pembayaran' => 10000, // 10.000
            'status_pembayaran' => 'sudah membayar',
        ]);

        return redirect()->route('kas.index')->with('success', 'Pembayaran berhasil dicatat.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
