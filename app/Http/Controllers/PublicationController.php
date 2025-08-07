<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications =  Publication::paginate(25);
        return view('pages.publications', compact('publications'));
    }
}