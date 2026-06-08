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
            $semesterDipilih = $request->semester ?? 1;

            // query data berdasarkan semester

            $ipsSemester = 0;
            $sksSemester = 0;
        
        $mahasiswa = Mahasiswa::where(
            'user_id',
            Auth::id()
        )->first();

        $krs = Krs::with([
            'detail.khs',
            'detail.pengajar.mataKuliah',
            'detail.pengajar.dosen',
            'detail.pengajar.kelas'
        ])
        ->where(
            'nim',
            $mahasiswa->nim
        )
        ->get();

        $semesterList = [];

        foreach($krs as $dataKrs){

            foreach($dataKrs->detail as $item){

                $semesterList[] =
                $item->pengajar->semester;
            }
        }

        $semesterList =
        collect($semesterList)
        ->unique()
        ->sort()
        ->values();

        $ips = 0;
        $ipk = $ips;
        $totalSksSemester = 0;
        $totalBobotSemester = 0;

        $totalBobotSemester = 0;
        $sksSemester = 0;

        foreach($krs as $dataKrs){

            foreach($dataKrs->detail as $item){

                if(
                    $item->pengajar->semester !=
                    $semesterDipilih
                ){
                    continue;
                }

                $sksSemester +=
                $item->pengajar
                    ->mataKuliah
                    ->sks;

                if(
                    !$item->khs ||
                    $item->khs->status != 'Final'
                ){
                    continue;
                }

                $sks =
                $item->pengajar
                    ->mataKuliah
                    ->sks;

                $bobot = match($item->khs->nh){
                    'A'  => 4,
                    'B+' => 3.5,
                    'B'  => 3,
                    'C+' => 2.5,
                    'C'  => 2,
                    'D+' => 1.5,
                    'D'  => 1,
                    default => 0
                };

                $totalBobotSemester +=
                ($bobot * $sks);
            }
        }

        $ipsSemester = 0;

        if($sksSemester > 0){
            $ipsSemester = round(
                $totalBobotSemester / $sksSemester,
                2
            );
        }

        if($totalSksSemester > 0){
            $ips = round(
                $totalBobotSemester / $totalSksSemester,
                2
            );
        }

        $totalSks = 0;

        foreach($krs as $dataKrs){

            foreach($dataKrs->detail as $item){

                $totalSks +=
                $item->pengajar
                    ->mataKuliah
                    ->sks;
            }
        }

        $semesterSaatIni = 1;

        foreach($krs as $dataKrs){

            foreach($dataKrs->detail as $item){

                if(
                    $item->pengajar->semester >
                    $semesterSaatIni
                ){
                    $semesterSaatIni =
                    $item->pengajar->semester;
                }
            }
        }

        

        return view(
            'mahasiswa.KhsMahasiswa',
            compact('krs',
                    'ips',
                    'ipk',
                    'totalSks',
                    'semesterSaatIni',
                    'semesterList',
                    'semesterDipilih',
                    'ipsSemester',
                    'sksSemester')
        );
    }
}