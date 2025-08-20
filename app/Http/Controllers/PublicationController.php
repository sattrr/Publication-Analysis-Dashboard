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

        $query = Publication::query();

        if ($request->has('year')) {
            $query->where('tahun', $request->year);
        }

        $publications = $query->orderBy($sort, $direction)
            ->paginate(25)
            ->withQueryString();

        if ($request->ajax() || $request->has('partial')) {
            return view('pages.partials.publications_table', compact('publications', 'sort', 'direction'));
        }

        return view('pages.publications', compact('publications', 'sort', 'direction'));
    }
}