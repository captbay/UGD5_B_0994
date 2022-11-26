<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Departemen;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Mail\ProyekMail; /* import model mail */
use Exception;
use Illuminate\Support\Facades\Mail as FacadesMail;

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


    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $departemen = Departemen::all();
        return view('proyek.create', compact('departemen'));
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'nilai_proyek' => 'required|Integer|min:10000000',
            'status' => 'required'
        ]);
        //Fungsi Simpan Data ke dalam Database
        Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'id_departemen' => $request->id_departemen,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'nilai_proyek' => $request->nilai_proyek,
            'status' => $request->status

        ]);
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama_proyek,
                'title' => 'Proyek',
            ];
            //Mengirim email ke emailtujuan@gmail.com
            FacadesMail::to('agespramana9@gmail.com')->send(new
                ProyekMail($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }

    /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function edit(Int $id)
    {
        $proyek = Proyek::find($id);
        $departemen = Departemen::all();

        return view('proyek.edit', compact('proyek', 'departemen'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $proyek
     * @return void
     */
    public function update(Request $request, Int $id)
    {
        //validate form
        $this->validate($request, [
            // 'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'nilai_proyek' => 'required|Integer|min:10000000',
            'status' => 'required'
        ]);

        //check if image is uploaded
        // if ($request->hasFile('image')) {

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/proyeks', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/proyeks/'.$proyek->image);

        //     //update proyek with new image
        //     $proyek->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);

        // } else { }   
        $proyek = Proyek::find($id);

        //update proyek without image
        $proyek->update([
            'nama_proyek' => $request->nama_proyek,
            'id_departemen' => $request->id_departemen,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'nilai_proyek' => $request->nilai_proyek,
            'status' => $request->status,
        ]);

        //redirect to index
        return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * destroy
     *
     * @param  mixed $proyek
     * @return void
     */
    public function destroy(Int $id)
    {
        // //delete image
        // Storage::delete('public/proyeks/' . $proyek->image);

        $proyek = Proyek::find($id);
        //delete proyek
        $proyek->delete();

        //redirect to index
        return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}