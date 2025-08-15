<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DashboardController extends Controller
{
    public function index()
    {
        $spreadsheet = IOFactory::load(storage_path('data\topic_assignments.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $publicationTrends = Publication::select(DB::raw('tahun, COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        $years = $publicationTrends->pluck('tahun');
        $totals = $publicationTrends->pluck('total');

        $totalPublications = Publication::count();

        $totalAuthors = Author::select('nama')
            ->distinct()
            ->count();

        $totalJournals = Publication::select('nama_jurnal')
            ->distinct()
            ->count();

        $totalTopics = Publication::select('topik')
            ->distinct()
            ->count();

        $topics = [];
        foreach ($rows as $i => $row) {
            if ($i === 0) continue;

            $topicId = $row[2] ?? null;
            $topicName = $row[4] ?? null;

            if ($topicId !== null && $topicId != -1 && $topicName) {
                // Bersihkan nama topik
                $cleanName = preg_replace('/^\d+_/', '', $topicName);
                $cleanName = str_replace('_', ' ', $cleanName);

                $topics[$cleanName] = ($topics[$cleanName] ?? 0) + 1;
            }
        }

        arsort($topics);
        $topTopics = array_slice($topics, 0, 10, true);

        $topicLabels = array_keys($topTopics);
        $topicCounts = array_values($topTopics);

        return view('pages.dashboard', [
            'years' => $years,
            'totals' => $totals,
            'totalPublications' => $totalPublications,
            'totalAuthors' => $totalAuthors,
            'totalJournals' => $totalJournals,
            'totalTopics' => $totalTopics,
            'topicLabels' => $topicLabels,
            'topicCounts' => $topicCounts,
        ]);
    }
}