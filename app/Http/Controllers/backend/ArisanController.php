<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detail_arisan;
use App\Models\arisan;
use App\Models\peserta;
use App\Rules\UniquePesertaInArisan;
use Illuminate\Support\Facades\DB;
use App\Models\PemenangArisan;
class ArisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arisanDetails = detail_arisan::all()->groupBy('arisan_id');
        $arisan = arisan::orderBy('created_at', 'desc')->get();
        $peserta = peserta::first();
        $tempat = peserta::whereNotIn('id', function($query) {
            $query->select('tempat_pelaksanaan')->from('arisan');
        })->get();

        $totalUsers = peserta::count();
        $pesertaOptions = peserta::pluck('name', 'id');
        return view('backend.arisan.index', compact('arisan', 'peserta', 'pesertaOptions','arisanDetails','totalUsers','tempat'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
            'tempat_pelaksanaan' => 'required',
            'tanggal_pelaksanaan' => 'required|date|unique:arisan',
            'keterangan' => 'required',
            'nominal' => 'required',
            //'peserta_id' => 'required|exists:pesertas,id' // Validasi bahwa peserta_id ada di tabel pesertas
        ]);

        // Buat arisan baru dengan data dari form
        $arisan = arisan::create([
            'tempat_pelaksanaan' => $request->tempat_pelaksanaan,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
          //  'peserta_id' => $request->peserta_id
        ]);

        return redirect()->route('arisan.index')->with('success', 'Arisan berhasil dibuat.');
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

        //  $request->validate([
        //     'peserta_id' => 'required|unique:detail_arisan',
        //     'nominal' => 'required',

        // ]);

        $request->validate([
            'peserta_id' => [
                'required',
                new UniquePesertaInArisan($id),
            ],
            'nominal' => 'required',
        ]);
        $arisan = arisan::find($id);


        detail_arisan::create([
            'peserta_id' => $request->peserta_id,
            'nominal' => $request->nominal,
            'arisan_id' => $arisan->id,
        ]);

        return redirect()->route('arisan.index')->with('success', 'Peserta Berhasil Ditambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arisan = arisan::findOrFail($id);
        $arisan->delete();

      return redirect()->route('arisan.index')->with('success', 'arisan deleted successfully.');
    }

    public function deletePeserta(string $id)
    {
        $detail_arisan = detail_arisan::findOrFail($id);
        $detail_arisan->delete();

      return redirect()->route('arisan.index')->with('success', 'peserta arisan deleted successfully.');

    }

    public function kocok($arisanId)
{
    try {

        $pesertaArisan = detail_arisan::where('arisan_id', $arisanId)->get();


        if ($pesertaArisan->isEmpty()) {
            return redirect()->route('arisan.index')->with('error', 'Tidak ada peserta terdaftar untuk arisan ini.');
        }

        // Acak urutan peserta
        $pemenang = $pesertaArisan->random();


        PemenangArisan::create([
            'arisan_id' => $arisanId,
            'peserta_id' => $pemenang->peserta_id,
        ]);

        return redirect()->route('arisan.index')->with('success', 'Pemenang arisan berhasil diambil.');
    } catch (\Exception $e) {
        return redirect()->route('arisan.index')->with('error', 'Gagal mencari pemenang arisan. ' . $e->getMessage());
    }
}



}
