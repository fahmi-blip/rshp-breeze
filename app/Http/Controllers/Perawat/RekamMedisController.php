<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        return view('perawat.rekam-medis.index');
    }
}
