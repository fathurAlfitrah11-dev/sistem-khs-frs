<!DOCTYPE html>
<html>
<head>
    <title>Kartu Hasil Studi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .meta-table { width: 100%; margin-bottom: 20px; }
        .meta-table td { padding: 3px 0; }
        
        /* DATA TABLE STYLING */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        
        /* FIX: Mengubah th menjadi text-align center agar semua kepala tabel berada di tengah */
        .data-table th { 
            background-color: #f5f5f5; 
            border: 1px solid #ddd; 
            padding: 8px; 
            font-weight: bold; 
            text-align: center; 
        }
        
        .data-table td { border: 1px solid #ddd; padding: 8px; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .footer { margin-top: 30px; text-align: right; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Smart Academy System</h2>
        <div style="font-size: 11px; color: #666; margin-top: 5px;">Kartu Hasil Studi (KHS) Mahasiswa</div>
    </div>

    <table class="meta-table">
        <tr>
            <td width="18%"><strong>Nama Mahasiswa</strong></td>
            <td width="32%">: {{ $mahasiswa->nama }}</td>
            <td width="18%"><strong>Semester</strong></td>
            <td width="32%">: {{ $semesterDipilih }}</td>
        </tr>
        <tr>
            <td><strong>NIM</strong></td>
            <td>: {{ $mahasiswa->nim }}</td>
            <td><strong>IPS Semester Ini</strong></td>
            <td>: <strong>{{ number_format($ipsSemester, 2) }}</strong></td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="15%">Kode</th>
                <th width="45%">Mata Kuliah</th>
                <th width="10%">SKS</th>
                <th width="15%">Nilai Angka</th>
                <th width="15%">Nilai Huruf</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSksCetak = 0; @endphp
            @foreach($krs as $dataKrs)
                @foreach($dataKrs->detail as $item)
                    @if(isset($item->pengajar->semester) && $item->pengajar->semester == $semesterDipilih)
                        @php $totalSksCetak += ($item->pengajar->mataKuliah->sks ?? 0); @endphp
                        <tr>
                            {{-- Kode, SKS, dan Nilai di tengah. Nama Matkul tetap di kiri agar rapi dibaca --}}
                            <td class="text-center" style="font-family: monospace;">{{ $item->pengajar->mataKuliah->kode_mk ?? '-' }}</td>
                            <td class="text-left" style="font-weight: bold;">{{ $item->pengajar->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="text-center">{{ $item->pengajar->mataKuliah->sks ?? 0 }}</td>
                            <td class="text-center">
                                {{ $item->khs ? $item->khs->na : 'Belum Dinilai' }}
                            </td>
                            <td class="text-center"><strong>{{ $item->khs ? $item->khs->nh : '-' }}</strong></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total SKS Diambil: {{ $totalSksCetak }} SKS
    </div>

</body>
</html>