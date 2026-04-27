<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
      public function index()
    {
        $prodi = Prodi::all();
        return view('admin.mata-kuliah.index', compact('prodi'));
    }
}
