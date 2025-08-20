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
        $spreadsheet = IOFactory::load($topicPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $domainCounts = [];
        $topicCounts = [];

        foreach ($rows as $i => $row) {
            if ($i === 0) continue;

            $domain = $row[5] ?? null;
            $topicName = $row[4] ?? null;

            if ($domain) {
                $domainCounts[$domain] = ($domainCounts[$domain] ?? 0) + 1;
            }
            if ($topicName && $topicName !== "-1") {
                $topicCounts[$topicName] = ($topicCounts[$topicName] ?? 0) + 1;
            }
        }

        arsort($domainCounts);
        arsort($topicCounts);

        $domainLabels = array_keys($domainCounts);
        $domainValues = array_values($domainCounts);

        $topicLabels = array_slice(array_keys($topicCounts), 0, 15);
        $topicValues = array_slice(array_values($topicCounts), 0, 15);

        $publicationTrends = Publication::select(DB::raw('tahun, COUNT(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        $years = $publicationTrends->pluck('tahun');
        $totals = $publicationTrends->pluck('total');

        $totalPublications = Publication::count();
        $totalAuthors = Author::distinct('nama')->count('nama');
        $totalJournals = Publication::distinct('nama_jurnal')->count('nama_jurnal');
        $totalTopics = count($topicCounts);

        return view('pages.dashboard', [
            'years' => $years,
            'totals' => $totals,
            'totalPublications' => $totalPublications,
            'totalAuthors' => $totalAuthors,
            'totalJournals' => $totalJournals,
            'totalTopics' => $totalTopics,
            'domainLabels' => json_encode($domainLabels),
            'domainValues' => json_encode($domainValues),
            'topicLabels' => $topicLabels,
            'topicCounts' => $topicValues,
            'allTopicLabels' => array_keys($topicCounts),
            'allTopicValues' => array_values($topicCounts),
        ]);
    }
}