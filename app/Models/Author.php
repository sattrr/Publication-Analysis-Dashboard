<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'penelitian.publikasi';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'id_scopus',
        'nama',
        'judul',
        'total_publikasi',
    ];

    public static function uniqueAuthors()
    {
        return self::select('nip', 'id_scopus', 'nama', 'judul')
            ->distinct();
    }
}
