<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::uniqueAuthors()->paginate(25);
        return view('pages.authors', compact('authors'));
    }
}
