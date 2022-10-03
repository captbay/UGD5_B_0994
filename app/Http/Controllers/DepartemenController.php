<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class DepartemenController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    

    public function index()
    {
        //get posts
        $departemen = Departemen::paginate(5);
        //render view with posts
        return view('departemen.index', compact('departemen'));
    }
}