<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tabungan;
use App\Models\peserta;
use App\Models\detail_tabungan;
use PDF;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabungan = tabungan::all();
        $peserta = peserta::all();
        return view('backend.tabungan.index', compact('tabungan', 'peserta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function generatePDF($id)
    {
        $tabungan = tabungan::find($id);

        if (!$tabungan) {
            return redirect()->route('tabungan.index')->with('error', 'Tabungan tidak ditemukan.');
        }

        $detailTabungan = $tabungan->detailTabungan;


        $totalNominal = $detailTabungan->sum('nominal');
        $pdf = PDF::loadView('backend.tabungan.tabungan-pdf', compact('tabungan','detailTabungan', 'totalNominal'));


        return $pdf->download('tabungan.pdf');
    }
    /**
     * Store a newly created resource in storage.
     */



    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|unique:tabungan',
            'nominal' => 'required|numeric',
        ]);


        $tabungan = tabungan::create([
            'user_id' => $request->user_id,
        ]);


        detail_tabungan::create([
            'tabungan_id' => $tabungan->id,
            'nominal' => $request->nominal,
            'tanggal' => now(),
        ]);

        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */


     public function tarikSaldo($id)
     {
         $tabungan = tabungan::find($id);

         if (!$tabungan) {
             return redirect()->route('tabungan.index')->with('error', 'Tabungan tidak ditemukan.');
         }
         $detailTabungan = $tabungan->detailTabungan;
         $totalNominal = $detailTabungan->sum('nominal');
         // Hapus data tabungan dan detail_tabungan
         $tabungan->delete();
         $pdf = PDF::loadView('backend.tabungan.tarik-saldo-pdf', compact('detailTabungan','tabungan','totalNominal'));

        // $totalNominal = $detailTabungan->sum('nominal');
         return $pdf->download('invoice-tarik-saldo.pdf');

         return redirect()->route('tabungan.index')->with('success', 'Saldo berhasil ditarik.');
     }


    public function show($id)
    {

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
        // Validasi input dari form
        $request->validate([
            'nominal' => 'required',
        ]);

        // Temukan tabungan berdasarkan ID
        $tabungan = tabungan::find($id);

        // Simpan detail tabungan
        detail_tabungan::create([
            'tabungan_id' => $tabungan->id,
            'nominal' => $request->nominal,
            'tanggal' => now(),
        ]);

        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        tabungan::find($id)->delete();
        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil dihapus.');
    }
}
