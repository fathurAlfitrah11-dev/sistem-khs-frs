<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TahunAjaranController extends Controller
{
    private function updateSemesterKelas()
{
    $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

    if (!$tahunAktif) return;

    $offset = $tahunAktif->semester == 'ganjil' ? 1 : 2;

    foreach (Kelas::all() as $kelas) {
        $selisih = max(0, $tahunAktif->tahun_awal - $kelas->angkatan);

        $kelas->update([
            'semester' => ($selisih * 2) + $offset
        ]);
    }
}

    public function index(Request $request)
    {
        $today = Carbon::parse('2027-02-15');

TahunAjaran::query()->update([
    'status' => 'non-aktif'
]);

TahunAjaran::whereDate('tanggal_mulai', '<=', $today)
    ->whereDate('tanggal_selesai', '>=', $today)
    ->update([
        'status' => 'aktif'
    ]);
    $this->updateSemesterKelas();
        $search = $request->search;

        // Tahun ajaran yang sedang aktif berdasarkan tanggal hari ini
        $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

        $data = TahunAjaran::when($search, function ($query) use ($search) {
                $query->where('tahun_awal', 'like', "%{$search}%")
                    ->orWhere('tahun_akhir', 'like', "%{$search}%")
                    ->orWhere('semester', 'like', "%{$search}%")
                    ->orWhereRaw(
                        "CONCAT(tahun_awal,'/',tahun_akhir) LIKE ?",
                        ["%{$search}%"]
                    );
            })
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10)
            ->appends($request->query());

        $data->getCollection()->transform(function ($item) {
    $item->aktif = now()->between($item->tanggal_mulai, $item->tanggal_selesai)
        ? 'aktif'
        : 'nonaktif';

    return $item;
});

        return view('admin.tahun-ajaran.index', compact(
            'data',
            'search',
            'tahunAktif'
        ));
    }

   public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'semester' => 'required|in:ganjil,genap',
        'tanggal_mulai' => 'required|date',
    ]);

    if ($validator->fails()) {
        return back()
            ->withInput()
            ->withErrors($validator, 'tambah')
            ->with('open_modal', 'tambah');
    }

    $tanggalMulai = Carbon::parse($request->tanggal_mulai);

    /**
     * Tahun ajaran SELALU ditentukan dari awal tahun akademik
     */

    if ($tanggalMulai->month >= 7) {
        // masuk tahun ajaran baru (ganjil)
        $tahunAwal = $tanggalMulai->year;
        $tahunAkhir = $tanggalMulai->year + 1;
    } else {
        // masih tahun ajaran sebelumnya (genap)
        $tahunAwal = $tanggalMulai->year - 1;
        $tahunAkhir = $tanggalMulai->year;
    }

    /**
     *  TANGGAL SELESAI
     */
    if ($request->semester == 'ganjil') {
        $tanggalSelesai = Carbon::create($tahunAkhir, 1, 31);
    } else {
        $tanggalSelesai = Carbon::create($tahunAkhir, 7, 31);
    }

    // cek duplikat
    $cek = TahunAjaran::where('tahun_awal', $tahunAwal)
        ->where('tahun_akhir', $tahunAkhir)
        ->where('semester', $request->semester)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Tahun ajaran sudah ada.');
    }

    TahunAjaran::create([
        'tahun_awal' => $tahunAwal,
        'tahun_akhir' => $tahunAkhir,
        'semester' => $request->semester,
        'tanggal_mulai' => $tanggalMulai,
        'tanggal_selesai' => $tanggalSelesai,
        'status' => 'non-aktif',
    ]);

    return redirect('/tahun-ajaran')
        ->with('success', 'Berhasil ditambahkan');
}

    public function update(Request $request, $id_tahun_ajaran)
{
    $tahun = TahunAjaran::findOrFail($id_tahun_ajaran);

    $validator = Validator::make($request->all(), [
        'semester' => 'required|in:ganjil,genap',
        'tanggal_mulai' => 'required|date',
    ]);

    if ($validator->fails()) {
        return back()
            ->withInput()
            ->withErrors($validator, 'edit')
            ->with('open_modal', 'edit');
    }

    $tanggalMulai = Carbon::parse($request->tanggal_mulai);

    /**
     * HITUNG ULANG TAHUN AJARAN
     */
    if ($tanggalMulai->month >= 7) {
        $tahunAwal = $tanggalMulai->year;
        $tahunAkhir = $tanggalMulai->year + 1;
    } else {
        $tahunAwal = $tanggalMulai->year - 1;
        $tahunAkhir = $tanggalMulai->year;
    }

    /**
     * HITUNG TANGGAL SELESAI
     */
    if ($request->semester == 'ganjil') {
        $tanggalSelesai = Carbon::create($tahunAkhir, 1, 31);
    } else {
        $tanggalSelesai = Carbon::create($tahunAkhir, 7, 31);
    }

    /**
     * CEK DUPLIKAT
     */
    $cek = TahunAjaran::where('tahun_awal', $tahunAwal)
        ->where('tahun_akhir', $tahunAkhir)
        ->where('semester', $request->semester)
        ->where('id_tahun_ajaran', '!=', $id_tahun_ajaran)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Tahun ajaran sudah ada.');
    }

    $tahun->update([
        'tahun_awal' => $tahunAwal,
        'tahun_akhir' => $tahunAkhir,
        'semester' => $request->semester,
        'tanggal_mulai' => $tanggalMulai,
        'tanggal_selesai' => $tanggalSelesai,
        'status' => 'non-aktif',
    ]);

    return redirect('/tahun-ajaran')
        ->with('success', 'Data berhasil diupdate');
}

    public function delete($id_tahun_ajaran)
    {
        $tahun = TahunAjaran::findOrFail($id_tahun_ajaran);

        // Jangan boleh menghapus tahun ajaran yang sedang aktif
        if (
            now()->between(
                $tahun->tanggal_mulai,
                $tahun->tanggal_selesai
            )
        ) {
            return redirect()->back()
                ->with('error', 'Tahun ajaran yang sedang aktif tidak dapat dihapus.');
        }

        $tahun->delete();

        return redirect('/tahun-ajaran')
            ->with('success', 'Data tahun ajaran berhasil dihapus.');
    }
}
