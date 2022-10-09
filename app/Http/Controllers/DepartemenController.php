<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\DepartemenMail; /* import model mail */
use App\Models\Departemen; /* import model departemen */
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Storage;

class DepartemenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get departemen
        $departemens = Departemen::latest()->paginate(5);
        //render view with posts
        return view('departemen.index', compact('departemens'));
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('departemen.create');
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
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
        ]);
        //Fungsi Simpan Data ke dalam Database
        Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai
        ]);
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama_departemen,
                'title' => 'Departemen',
            ];
            //Mengirim email ke emailtujuan@gmail.com
            FacadesMail::to('agespramana9@gmail.com')->send(new
                DepartemenMail($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
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
        $departemen = Departemen::find($id);

        return view('departemen.edit', compact('departemen'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $departemen
     * @return void
     */
    public function update(Request $request, Int $id)
    {
        //validate form
        $this->validate($request, [
            // 'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
        ]);

        //check if image is uploaded
        // if ($request->hasFile('image')) {

        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/departemens', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/departemens/'.$departemen->image);

        //     //update departemen with new image
        //     $departemen->update([
        //         'image'     => $image->hashName(),
        //         'title'     => $request->title,
        //         'content'   => $request->content
        //     ]);

        // } else { }   
        $departemen = Departemen::find($id);

        //update departemen without image
        $departemen->update([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai
        ]);

        //redirect to index
        return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * destroy
     *
     * @param  mixed $departemen
     * @return void
     */
    public function destroy(Int $id)
    {
        // //delete image
        // Storage::delete('public/departemens/' . $departemen->image);

        $departemen = Departemen::find($id);
        //delete departemen
        $departemen->delete();

        //redirect to index
        return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}