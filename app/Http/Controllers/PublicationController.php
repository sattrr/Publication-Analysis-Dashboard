use App\Models\Publication;

public function index()
{
    $years = Publication::selectRaw('year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year')
        ->pluck('total', 'year');

    return view('dashboard', [ // ganti 'dashboard' dengan nama blade-mu
        'years' => $years->keys(),
        'totals' => $years->values(),
    ]);
}