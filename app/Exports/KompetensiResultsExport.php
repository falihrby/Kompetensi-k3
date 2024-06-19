<?php

namespace App\Exports;

use App\Models\KompetensiResult;
use Maatwebsite\Excel\Concerns\FromCollection;

class KompetensiResultsExport implements FromCollection
{
    public function collection()
    {
        return KompetensiResult::all();
    }
}
