<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class KpsPenguncianController extends Controller
{
public function index()
{
    $dosen = Dosen::where(
        'user_id',
        Auth::id()
    )->first();

    $matkul = MataKuliah::whereHas(
        'prodi',
        function($q) use($dosen){

            $q->where(
                'nik_kps',
                $dosen->nik
            );

        }
    )->get();

    return view(
        'dosen.kps.index',
        compact('matkul')
    );
}

public function update(Request $request,$kode_mk)
{
    $mk = MataKuliah::findOrFail($kode_mk);

    if($mk->dikunci)
    {
        return back()
        ->with('error','Bobot sudah dikunci');
    }

    $total =
        $request->persen_partisipatif
        + $request->persen_tugas
        + $request->persen_quiz
        + $request->persen_proyek
        + $request->persen_uts
        + $request->persen_uas;

    if($total != 100)
    {
        return back()
        ->with('error','Total bobot harus 100%');
    }

    $mk->update([

        'persen_partisipatif'=>$request->persen_partisipatif,
        'persen_tugas'=>$request->persen_tugas,
        'persen_quiz'=>$request->persen_quiz,
        'persen_proyek'=>$request->persen_proyek,
        'persen_uts'=>$request->persen_uts,
        'persen_uas'=>$request->persen_uas

    ]);

    return back()
    ->with('success','Bobot berhasil diubah');
}

public function kunci($kode_mk)
{
    $mk = MataKuliah::findOrFail($kode_mk);

      $mk->update([
          'dikunci'=>true
      ]);

    return back()
    ->with('success','Bobot berhasil dikunci');
}

public function bukaKunci($kode_mk)
{
    $mk = MataKuliah::findOrFail($kode_mk);

    $mk->update([
        'dikunci'=>false
    ]);

    return back()
    ->with('success','Bobot berhasil dibuka');
}

public function simpan(Request $request)
{
    foreach ($request->kode_mk as $kode_mk)
    {
        $mk = MataKuliah::findOrFail($kode_mk);

        // kalau sudah dikunci tidak boleh diubah
        if(!$mk->dikunci)
          $total =
            $request->persen_partisipatif[$kode_mk]
            + $request->persen_tugas[$kode_mk]
            + $request->persen_quiz[$kode_mk]
            + $request->persen_proyek[$kode_mk]
            + $request->persen_uts[$kode_mk]
            + $request->persen_uas[$kode_mk];

        if ($total != 100)
        {
            return back()
                ->with('error', 'Total bobot '.$mk->nama_mk.' harus 100%');
        }
        {
            $mk->update([

                'persen_partisipatif' =>
                $request->persen_partisipatif[$kode_mk],

                'persen_tugas' =>
                $request->persen_tugas[$kode_mk],

                'persen_quiz' =>
                $request->persen_quiz[$kode_mk],

                'persen_proyek' =>
                $request->persen_proyek[$kode_mk],

                'persen_uts' =>
                $request->persen_uts[$kode_mk],

                'persen_uas' =>
                $request->persen_uas[$kode_mk]

            ]);
        }
    }

    return back()
        ->with('success','Bobot berhasil disimpan');
}
}