<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mstr_Hospitals extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mstr__hospitals')->insert(
            [
                [
                    'hospital_name' => 'Rs.Sartika Asih',
                    'address' => 'BANDUNG , Jl.Moch Toha',
                    'email' => 'info@sartika_asih.com',
                    'telephone' => '0838479832479',
                ],
                [
                    'hospital_name' => 'Rs.Imanuel',
                    'address' => 'BANDUNG. Jl. Kopo No. 161 Situsaeur Bandung 40234',
                    'email' => 'info@Imanuel.com',
                    'telephone' => '088297392822',
                ],
                [
                    'hospital_name' => 'Rs.sakia',
                    'address' => 'BANDUNG. Jl. Wahid Hasyim (KOPO) Bandung 311',
                    'email' => 'info@sakia.com',
                    'telephone' => '089993727392',
                ],
                [
                    'hospital_name' => 'Rs.al-ikhsan',
                    'address' => 'BANDUNG. Jl. Balendah ',
                    'email' => 'al-ikhsan@info.com',
                    'telephone' => '06378927467',
                ],
            ]
        );
    }
}
