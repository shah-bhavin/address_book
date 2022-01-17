<?php

namespace App\Imports;

use App\Models\Mapping;
use Maatwebsite\Excel\Concerns\ToModel;

class MapImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0]!=''){
            return new Mapping([
                'disease_ref'     => $row[0],
                'diet_ref'    => $row[1], 
                'treatment_ref' => $row[2],
            ]);
        }        
    }
}
