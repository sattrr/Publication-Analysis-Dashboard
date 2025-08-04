use Illuminate\Database\Seeder;
use App\Imports\PublicationsImport;
use Maatwebsite\Excel\Facades\Excel;

class PublicationSeeder extends Seeder
{
    public function run()
    {
        Excel::import(new PublicationsImport, base_path('app/public/publications.xlsx'));
    }
}