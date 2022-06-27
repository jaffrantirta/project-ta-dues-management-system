<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UsersActiveExport implements FromQuery, WithHeadings
{
    use Exportable;

    // public function __construct($place_id, $date_start, $date_end)
    // {
    //     $this->place_id = $place_id;
    //     $this->date_start = $date_start;
    //     $this->date_end = $date_end;
    // }

    public function query()
    {
        return User::query()
        ->select('name', 'email', 'phone', 'sex', 'date_of_birth')
        ->where('is_active', true)
        ->role('Member');
    }
    public function headings(): array
    {
        return ['Nama', 'Email', 'Telepon', 'Jenis Kelamin', 'Tanggal Lahir'];
    }
}