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
        $topicPath = storage_path('data/topic_assignments.xlsx');
        $topicListPath = storage_path('data/topics_list.xlsx');

        $spreadsheet = IOFactory::load($topicPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $topicsListSpreadsheet = IOFactory::load($topicListPath);
        $topicsListSheet = $topicsListSpreadsheet->getActiveSheet();
        $topicsListRows = $topicsListSheet->toArray();
        $topicsList = array_filter(array_map('trim', array_column($topicsListRows, 0)));
        $totalTopics = count(array_unique($topicsList));

        $publicationTrends = Publication::select(DB::raw('tahun, COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        $years = $publicationTrends->pluck('tahun');
        $totals = $publicationTrends->pluck('total');

        $totalPublications = Publication::count();

        $totalAuthors = Author::distinct('nama')->count('nama');

        $totalJournals = Publication::distinct('nama_jurnal')->count('nama_jurnal');

        $topics = [];
        foreach ($rows as $i => $row) {
            if ($i === 0) continue;

            $topicId = $row[2] ?? null;
            $topicName = $row[4] ?? null;

            if ($topicId !== null && $topicId != -1 && $topicName) {
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