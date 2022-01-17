<?php

namespace App\Exports;

use App\Models\Mapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class MapExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mapping::all();
    }
}
