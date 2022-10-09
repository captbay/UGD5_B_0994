<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */


    protected $table = "proyeks";



    public function departemens()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }

    protected $fillable = [
        'nama_proyek',
        'id_departemen',
        'waktu_mulai',
        'waktu_selesai',
        'nilai_proyek',
        'status'
    ];
}