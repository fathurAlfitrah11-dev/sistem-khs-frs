# Seeder: Checklist sebelum `db:seed`

Tujuan: memastikan seeder sampai level `pengajar` **tidak error** karena mismatch kolom/tabel.

## Referensi tabel & FK
- `prodi`
  - kolom: `id_prodi, jenjang, nama_prodi, nik_kps, nilai_dikunci?`
- `kelas`
  - enum: `nama_kelas` harus salah satu: A,B,C,D,E
  - enum: `kategori` harus salah satu: Pagi,Malam
  - FK: `id_prodi -> prodi.id_prodi`
  - FK: `nik_wali -> dosen.nik` (nullable)
- `mata_kuliah`
  - PK: `kode_mk`
  - FK: `id_prodi -> prodi.id_prodi`
  - kolom tambahan setelah migration: `persen_*`, `dikunci`
- `dosen`
  - PK: `nik`
  - FK: `user_id -> users.id`
- `pengajar`
  - FK: `nik -> dosen.nik`
  - FK: `kode_mk -> mata_kuliah.kode_mk`
  - FK: `kelas_id -> kelas.id_kelas`
  - FK: `id_tahun_ajaran -> tahun_ajaran.id_tahun_ajaran`

## Data seed harus konsisten
- `PengajarSeeder` mengacu:
  - `kode_mk` = IF201, IF202
  - `nik` = 19900101, 19900102
  - `kelas_id` = 1 (harus ada di `KelasSeeder`)
  - `id_tahun_ajaran` = 1 (harus ada di `TahunAjaranSeeder`)

## Urutan panggilan seeder (di DatabaseSeeder)
Pastikan urutan:
1. UserSeeder
2. DosenSeeder
3. ProdiSeeder
4. MataKuliahSeeder
5. KelasSeeder
6. TahunAjaranSeeder
7. PengajarSeeder

Karena `pengajar` butuh semua referensi FK di atas.

