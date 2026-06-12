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
            'detail.khs',
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

        // 2. LOGIKA HITUNG IPS & IPK BERDASARKAN MATA KULIAH YANG SUDAH DINILAI
        $sksSemester = 0;
        $totalBobotSemester = 0;
        $totalSks = 0; 
        $totalBobotKumulatif = 0;
        $totalSksKumulatif = 0;

      // 2. LOGIKA HITUNG IPS & IPK (Ganti total dari foreach lama ke versi ini)
        $sksSemester = 0;
        $totalBobotSemester = 0;
        $totalSks = 0;
        $totalBobotKumulatif = 0;
        $totalSksKumulatif = 0;

        foreach ($krs as $dataKrs) {
            foreach ($dataKrs->detail as $item) {
                $sks = $item->pengajar->mataKuliah->sks ?? 0;
                $semesterMatkul = isset($item->pengajar->semester) ? intval($item->pengajar->semester) : 0;
                
                if ($semesterMatkul === $semesterDipilih) {
                    $totalSks += $sks; 
                }

                if ($item->khs && $item->khs->nh) {
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

                    // Akumulasi Global untuk IPK
                    $totalSksKumulatif += $sks;
                    $totalBobotKumulatif += ($bobot * $sks);

                    // Akumulasi khusus Semester Terpilih untuk pembagi IPS
                    if ($semesterMatkul === $semesterDipilih) {
                        $sksSemester += $sks; // SKS ini hanya bertambah jika matkul SUDAH ADA nilainya
                        $totalBobotSemester += ($bobot * $sks);
                    }
                }
            }
        }
        $ipsSemester = $sksSemester > 0 ? round($totalBobotSemester / $sksSemester, 2) : 0.00;
        $ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0.00;
        $ips = $ipsSemester; 

        $persen_ipk = ($ipk / 4.0) * 100;

        return view('mahasiswa.KhsMahasiswa', compact(
            'krs', 'ips', 'ipk', 'totalSks', 'semesterSaatIni',
            'semesterList', 'semesterDipilih', 'ipsSemester', 'sksSemester', 'persen_ipk'
        ));
    }

    // 3. CETAK PDF SINKRON DATA
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