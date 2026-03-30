<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion">

    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-3">KRS APP</div>
    </a>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
@if (Auth::user()->role === 'admin')
    <li class="nav-item">
        <a class="nav-link" href="/mahasiswa-admin">
            <i class="fas fa-user"></i>
            <span>Mahasiswa</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="dropdown-toggle nav-link" href="#" id="dosenDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-chalkboard-teacher"></i>
            <span>Dosen</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="dosenDropdown">
            <a class="dropdown-item" href="/dosen-admin">Data Dosen</a>
            <a class="dropdown-item" href="/dosen-wali">Data Dosen Wali</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/prodi">
            <i class="fas fa-building"></i>
            <span>Program Studi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="dropdown-toggle nav-link" href="#" id="akademikDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-chalkboard-teacher"></i>
            <span>Data Akademik</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="akademikDropdown">
            <a class="dropdown-item" href="/mata-kuliah">Data Mata Kuliah</a>
            <a class="dropdown-item" href="/tahun-ajaran">Data Tahun Ajaran</a>
            <a class="dropdown-item" href="/pengajar">Data Pengajar</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/kelas">
            <i class="fas fa-book"></i>
            <span>Kelas</span>
        </a>
    </li>
    @endif
    @if (Auth::user()->role === 'mahasiswa')
    <li class="nav-item">
        <a class="nav-link" href="/krs">
            <i class="fas fa-file-alt"></i>
            <span>KRS</span>
        </a>
    </li>
    @endif
</ul>