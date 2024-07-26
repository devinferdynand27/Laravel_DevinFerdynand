<?php

namespace App\Exports;

use App\Models\Mstr_Hospital;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mstr_Hospital::all();
    }
}
