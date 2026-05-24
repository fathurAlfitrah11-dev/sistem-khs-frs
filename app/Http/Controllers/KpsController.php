<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KpsController extends Controller
{
     public function index()
    {
        return view('admin.kps.index');
}}
