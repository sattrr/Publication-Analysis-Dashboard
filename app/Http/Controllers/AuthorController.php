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

        $authors = Author::uniqueAuthors($sort, $direction)
            ->paginate(25)
            ->withQueryString();

        return view('pages.authors', compact('authors', 'sort', 'direction'));
    }
}
