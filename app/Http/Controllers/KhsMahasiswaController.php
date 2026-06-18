<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\Khs;
use Illuminate\Support\Facades\Auth;

class KhsMahasiswaController extends Controller
{
   public function index(Request $request)
{
    $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    if (!$mahasiswa) {
        abort(404, 'Data Mahasiswa Tidak Ditemukan');
    }

    $krs = Krs::with([
        'detail.khs', // Kita ambil data KHS murni dulu untuk di-filter di bawah
        'detail.pengajar.mataKuliah',
        'detail.pengajar.dosen',
        'detail.pengajar.kelas'
    ])
    ->where('nim', $mahasiswa->nim)
    ->get();

    // 1. Ambil daftar semester dari KRS secara dinamis
    $semesterList = [];
    foreach ($krs as $dataKrs) {
        foreach ($dataKrs->detail as $item) {
            if (isset($item->pengajar->semester)) {
                $semesterList[] = intval($item->pengajar->semester);
            }
        }
    }

    $semesterList = collect($semesterList)->unique()->sort()->values()->toArray();
    $semesterSaatIni = !empty($semesterList) ? max($semesterList) : 1;
    $semesterDipilih = $request->has('semester') ? intval($request->semester) : $semesterSaatIni;


    $totalSksSemester = 0;   
    $sksHitungSemester = 0; 
    $bobotSemester = 0;    
    $totalSksKumulatif = 0; 
    $bobotKumulatif = 0;   
    foreach ($krs as $dataKrs) {
    foreach ($dataKrs->detail as $item) {

        if ($item->status_wali != 'disetujui') {
            continue;
        }

        $sks = $item->pengajar->mataKuliah->sks ?? 0;
        $semesterMatkul = intval($item->pengajar->semester ?? 0);

        if ($semesterMatkul === $semesterDipilih) {
            $totalSksSemester += $sks;
        }

            // KUNCI UTAMA: Nilai HANYA diproses jika KHS ada, Nilai Huruf ada, DAN STATUSNYA SUDAH 'Final'!
            if ($item->khs && $item->khs->nh && $item->khs->status === 'Final') {
                $bobot = match ($item->khs->nh) {
                    'A'  => 4.0,
                    'B+' => 3.5,
                    'B'  => 3.0,
                    'C+' => 2.5,
                    'C'  => 2.0,
                    'D+' => 1.5,
                    'D'  => 1.0,
                    default => 0.0
                };

     
                $totalSksKumulatif += $sks;
                $bobotKumulatif += ($bobot * $sks);

           
                if ($semesterMatkul === $semesterDipilih) {
                    $sksHitungSemester += $sks;
                    $bobotSemester += ($bobot * $sks);
                }
            } else {

                if ($item->khs) {
                    $item->khs->id_khs = null;
                }
            }
        }
    }

    // Kalkulasi Akhir IPS dan IPK Resmi
    $ipsSemester = $sksHitungSemester > 0 ? round($bobotSemester / $sksHitungSemester, 2) : 0.00;
    $ipk = $totalSksKumulatif > 0 ? round($bobotKumulatif / $totalSksKumulatif, 2) : 0.00;
    
    $persen_ipk = ($ipk / 4.0) * 100;
    $totalSks = $totalSksSemester; 
    return view('mahasiswa.KhsMahasiswa', compact(
        'krs', 'ipk', 'totalSks', 'semesterSaatIni',
        'semesterList', 'semesterDipilih', 'ipsSemester', 'persen_ipk'
    ));
}
 
    public function cetakPdf(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $semesterDipilih = $request->semester ?? 1;

        $krs = Krs::with([
            'detail.khs',
            'detail.pengajar.mataKuliah',
            'detail.pengajar.dosen'
        ])
        ->where('nim', $mahasiswa->nim)
        ->get();

        $sksSemester = 0;
        $totalBobotSemester = 0;
        foreach ($krs as $dataKrs) {
            foreach ($dataKrs->detail as $item) {
                if (isset($item->pengajar->semester) && $item->pengajar->semester == $semesterDipilih) {
                    if ($item->khs && $item->khs->nh) {
                        $sks = $item->pengajar->mataKuliah->sks ?? 0;
                        $bobot = match ($item->khs->nh) { 'A'=>4.0,'B+'=>3.5,'B'=>3.0,'C+'=>2.5,'C'=>2.0,'D+'=>1.5,'D'=>1.0, default=>0.0 };
                        $sksSemester += $sks;
                        $totalBobotSemester += ($bobot * $sks);
                    }
                }
            }
        }
        $ipsSemester = $sksSemester > 0 ? round($totalBobotSemester / $sksSemester, 2) : 0.00;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('mahasiswa.khs_pdf', compact('krs', 'mahasiswa', 'semesterDipilih', 'ipsSemester'));
        return $pdf->download('KHS_Semester_' . $semesterDipilih . '.pdf');
    }
}