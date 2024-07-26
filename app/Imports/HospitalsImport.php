<?php

namespace App\Imports;

use App\Models\Mstr_Hospital;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HospitalsImport implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
                Mstr_Hospital::create([
                    'hospital_name' => $row['hospital_name'],
                    'address' => $row['address'],
                    'email' => $row['email'],
                    'telephone' => $row['telephone'],
                ]);
        }
    }
}
