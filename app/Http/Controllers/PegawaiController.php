<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Pegawai;
use App\Models\Departemen;
use App\Mail\PegawaiMail; /* import model mail */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;


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
        $pegawai = Pegawai::with(['departemens'])->paginate(5);
        //coba cari cara konek ke departemen
        // $pegawai = Pegawai::paginate(5);

        //render view with posts
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $departemen = Departemen::all();
        return view('pegawai.create', compact('departemen'));
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
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required|max:15',
            'id_departemen' => 'required',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'telepon' => 'required|regex:/^(0)8[1-9][0-9]{3,4}$/|min:6|max:7',
            'gender' => 'required',
            'gaji_pokok' => 'required|Integer|min:2000000',
            'status' => 'required'

        ]);
        //Fungsi Simpan Data ke dalam Database
        Pegawai::create([
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'gaji_pokok' => $request->gaji_pokok,
            'status' => $request->status,

        ]);
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama_pegawai,
                'title' => 'Pegawai',
            ];
            //Mengirim email ke emailtujuan@gmail.com
            FacadesMail::to('agespramana9@gmail.com')->send(new
                PegawaiMail($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
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
        $departemen = Departemen::all();
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai', 'departemen'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $pegawai
     * @return void
     */
    public function update(Request $request, Int $id)
    {
        //validate form
        $this->validate($request, [
            // 'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required|max:15',
            'id_departemen' => 'required',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'telepon' => 'required|regex:/^(0)8[1-9][0-9]{3,4}$/|min:6|max:7',
            'gender' => 'required',
            'gaji_pokok' => 'required|Integer|min:2000000',
            'status' => 'required'
        ]);

        //check if image is uploaded
        // if ($request->hasFile('image')) {

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/pegawais', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/pegawais/'.$pegawai->image);

        //     //update pegawai with new image
        //     $pegawai->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);

        // } else { }   
        $pegawai = Pegawai::find($id);

        //update pegawai without image
        $pegawai->update([
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'gaji_pokok' => $request->gaji_pokok,
            'status' => $request->status,
        ]);

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * destroy
     *
     * @param  mixed $pegawai
     * @return void
     */
    public function destroy(Int $id)
    {
        // //delete image
        // Storage::delete('public/pegawais/' . $pegawai->image);

        $pegawai = Pegawai::find($id);
        //delete pegawai
        $pegawai->delete();

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}