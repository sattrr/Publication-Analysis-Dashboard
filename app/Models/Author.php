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

    public function getNamaFormattedAttribute()
    {
        return $this->formatTitleCase($this->nama);
    }

    public function getJudulFormattedAttribute()
    {
        return $this->formatTitleCase($this->judul);
    }
}