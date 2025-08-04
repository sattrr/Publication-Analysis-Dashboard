namespace App\Imports;

use App\Models\Publication;
use Maatwebsite\Excel\Concerns\ToModel;

class PublicationsImport implements ToModel
{
    public function model(array $row)
    {
        return new Publication([
            'title' => $row[0],
            'year' => $row[1],
            // sesuaikan dengan kolom Excel
        ]);
    }
}