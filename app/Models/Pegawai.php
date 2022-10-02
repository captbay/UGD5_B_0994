<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    public function Departemen()
    {
        return $this->hasOne(Departemen::class);
    }

    protected $fillable = [
        'nomor_induk_pegawai',
        'nama_pegawai',
        'id_departemen',
        'email',
        'telepon',
        'gender',
        'gaji_pokok',
        'status',
    ];
}