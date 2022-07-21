<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class NilaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            ['nis' => 1001 , 'kode_mata_pelajaran' => 'B01' , 'nilai' => 100 , 'grade' => ''],
            ['nis' => 1002 , 'kode_mata_pelajaran' => 'B02' , 'nilai' => 90 , 'grade' => ''],
            ['nis' => 1003 , 'kode_mata_pelajaran' => 'A01' , 'nilai' => 80 , 'grade' => ''],
        ];
        
        DB::table('nilai')->insert($nilai);
    }
}
