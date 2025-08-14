<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'penelitian.publikasi';
    protected $primaryKey = 'id';
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

    private function formatTitleCase($text)
    {
        if (!$text) {
            return $text;
        }

        $smallWords = ['dan', 'atau', 'of', 'in', 'on', 'at', 'the', 'a', 'an'];

        $words = explode(' ', strtolower($text));

        $words = array_map(function ($word, $index) use ($smallWords) {
            if ($index === 0 || !in_array($word, $smallWords)) {
                return ucfirst($word);
            }
            return $word;
        }, $words, array_keys($words));

        return implode(' ', $words);
    }

    public function getJudulFormattedAttribute()
    {
        return $this->formatTitleCase($this->judul);
    }

    public function getNamaFormattedAttribute()
    {
        return $this->formatTitleCase($this->nama);
    }

    public function getJenisPublikasiFormattedAttribute()
    {
        return $this->formatTitleCase($this->jenis_publikasi);
    }

    public function getNamaJurnalFormattedAttribute()
    {
        return $this->formatTitleCase($this->nama_jurnal);
    }
}