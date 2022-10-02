<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Pegawai;
use Illuminate\Http\Request;


class PegawaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        // $pegawai = Pegawai::with(['departemens'])->paginate(5);
        //coba cari cara konek ke departemen
        $pegawai = Pegawai::paginate(5);


        //render view with posts
        return view('pegawai.index', compact('pegawai'));
    }
}