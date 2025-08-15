<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'tahun');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['judul', 'nama', 'jenis_publikasi', 'nama_jurnal', 'tahun', 'sumber_data'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'tahun';
        }

        $publications = Publication::orderBy($sort, $direction)
            ->paginate(25)
            ->withQueryString();

        return view('pages.publications', compact('publications', 'sort', 'direction'));
    }
}