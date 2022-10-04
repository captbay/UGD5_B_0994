<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $table = "departemens";



    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_departemen', 'id');
    }

    public function proyeks()
    {
        return $this->hasMany(Proyek::class, 'id_departemen', 'id');
    }

    protected $fillable = [
        'nama_departemen',
        'nama_manager',
        'jumlah_pegawai',
    ];
}