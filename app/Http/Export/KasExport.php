<?php

namespace App\Exports;

use App\Models\kas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KasExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return kas::all();
    }

    
}
