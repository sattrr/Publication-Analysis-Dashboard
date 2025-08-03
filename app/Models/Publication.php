<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'id_scopus',
        'nama',
        'judul',
        'jenis_publikasi',
        'nama_jurnal',
        'tautan',
        'doi',
        'tahun',
        'sumber_data'
    ];
}