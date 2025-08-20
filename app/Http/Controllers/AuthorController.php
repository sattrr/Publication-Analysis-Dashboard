<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'total_publikasi');
        $direction = $request->get('direction', 'desc');

        $query = Author::query();

        $authors = Author::uniqueAuthors($sort, $direction)
        ->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->search;
            $q->where(function ($q2) use ($search) {
                $q2->where('nama', 'like', "%{$search}%")
                ->orWhere('nip', 'like', "%{$search}%")
                ->orWhere('id_scopus', 'like', "%{$search}%");
            });
        })
        ->paginate(25)
        ->withQueryString();

        return view('pages.authors', compact('authors', 'sort', 'direction'));
    }
}
