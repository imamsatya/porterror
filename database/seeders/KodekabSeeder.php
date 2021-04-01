<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodekabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('kodekabs')->insert([
            //Kepala BPS
            [
                'name'  => 'BPS Provinsi Sulawesi Tengah',
                'email' => 'bps7200@bps.go.id',
                'kode' => '7200'
            ],
            [
                'name'  => 'BPS Kabupaten Banggai Kepulauan',
                'email' => 'bps7201@bps.go.id',
                'kode' => '7201'
            ],
            [
                'name'  => 'BPS Kabupaten Banggai',
                'email' => 'bps7202@bps.go.id',
                'kode' => '7202'
            ],
            [
                'name'  => 'BPS Kabupaten Morowali',
                'email' => 'bps7203@bps.go.id',
                'kode' => '7203'
            ],
            [
                'name'  => 'BPS Kabupaten Poso',
                'email' => 'bps7204@bps.go.id',
                'kode' => '7204'
            ],
            [
                'name'  => 'BPS Kabupaten Donggala',
                'email' => 'bps7205@bps.go.id',
                'kode' => '7205'
            ],
            [
                'name'  => 'BPS Kabupaten Tolitoli',
                'email' => 'bps7206@bps.go.id',
                'kode' => '7206'
            ],
            [
                'name'  => 'BPS Kabupaten Buol',
                'email' => 'bps7207@bps.go.id',
                'kode' => '7207'
            ],
            [
                'name'  => 'BPS Kabupaten Parigi Moutong',
                'email' => 'bps7208@bps.go.id',
                'kode' => '7208'
            ],
            [
                'name'  => 'BPS Kabupaten Tojo Una - una',
                'email' => 'bps7209@bps.go.id',
                'kode' => '7209'
            ],
            [
                'name'  => 'BPS Kabupaten Sigi',
                'email' => 'bps7210@bps.go.id',
                'kode' => '7210'
            ],
            [
                'name'  => 'BPS Kota Palu',
                'email' => 'bps7271@bps.go.id',
                'kode' => '7271'
            ],
            
         ]);
    }
}