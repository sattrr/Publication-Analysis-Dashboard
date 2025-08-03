<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $publicationTrends = Publication::select(DB::raw('tahun, COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        $years = $publicationTrends->pluck('tahun');
        $totals = $publicationTrends->pluck('total');

        return view('pages.dashboard', [
            'years' => $years,
            'totals' => $totals,
        ]);
    }
}