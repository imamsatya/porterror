<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
            //Kepala BPS
            [
                'name'  => 'bps7200',
                'email' => 'bps7200@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '1'
            ],
            [
                'name'  => 'bps7201',
                'email' => 'bps7201@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '2'
            ],
            [
                'name'  => 'bps7202',
                'email' => 'bps7202@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '3'
            ],
            [
                'name'  => 'bps7203',
                'email' => 'bps7203@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '4'
            ],
            [
                'name'  => 'bps7204',
                'email' => 'bps7204@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '5'
            ],
            [
                'name'  => 'bps7205',
                'email' => 'bps7205@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '6'
            ],
            [
                'name'  => 'bps7206',
                'email' => 'bps7206@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '7'
            ],
            [
                'name'  => 'bps7207',
                'email' => 'bps7207@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '8'
            ],
            [
                'name'  => 'bps7208',
                'email' => 'bps7208@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '9'
            ],
            [
                'name'  => 'bps7209',
                'email' => 'bps7209@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '10'
            ],
            [
                'name'  => 'bps7210',
                'email' => 'bps7210@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '11'
            ],
            [
                'name'  => 'bps7271',
                'email' => 'bps7271@bps.go.id',
                'password' => Hash::make('12341234'),
                'kab_id' => '12'
            ]

        ]);
    }
}
