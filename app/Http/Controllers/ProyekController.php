<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * index
     *
     * @return void
     */




    public function index()
    {
        //get posts
        $proyek = Proyek::with(['departemens'])->paginate(5);

        $parseDate = function ($value) {
            return Carbon::parse($value)->locale('id-ID')->translatedFormat('d F Y');
        };

        //render view with posts
        return view("proyek.index", compact("proyek", "parseDate"));
    }
}