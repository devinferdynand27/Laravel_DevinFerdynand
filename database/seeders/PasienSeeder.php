<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pasiens')->insert(
            [
                [
                    'patient_name' => 'Andika Saputra',
                    'address' => 'BANDUNG , Jl.Cibadyut Perbas',
                    'hospital_id' => '1',
                    'phone_number' => '372927392',
                ],
                [
                    'patient_name' => 'Amelia Rahma',
                    'address' => 'BANDUNG , Jl.Cikutra Barat',
                    'hospital_id' => '2',
                    'phone_number' => '08329732927',
                ],
                [
                    'patient_name' => 'Devin Ferdynand',
                    'address' => 'BANDUNG , Jl.Moch Toha Perbas',
                    'hospital_id' => '2',
                    'phone_number' => '083833014798',
                ],
                [
                    'patient_name' => 'Zazkia Ghefira',
                    'address' => 'BANDUNG , Jl.Banjaran',
                    'hospital_id' => '3',
                    'phone_number' => '083833014798',
                ],
                [
                    'patient_name' => 'Yusnidar ',
                    'address' => 'BANDUNG , Jl.muara bungo',
                    'hospital_id' => '3',
                    'phone_number' => '203678906789',
                ],
                [
                    'patient_name' => 'Azriel Rabani Sidik ',
                    'address' => 'BANDUNG , Jl.cibaduyut',
                    'hospital_id' => '2',
                    'phone_number' => '0283238203879',
                ],
                [
                    'patient_name' => 'Fawwaz Sanad ',
                    'address' => 'BANDUNG , Jl.Tasik',
                    'hospital_id' => '3',
                    'phone_number' => '0283292323',
                ],
                
            ]
        );
    }
}
