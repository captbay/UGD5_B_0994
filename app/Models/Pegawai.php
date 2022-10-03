<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;

class Pegawai extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */


    protected $table = "pegawais";

    

    public function departemens()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
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