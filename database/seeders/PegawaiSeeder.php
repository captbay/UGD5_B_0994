<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('pegawais')->insert([
                'nomor_induk_pegawai' => $faker->numberBetween(200710994, 200711999),
                'nama_pegawai' => $faker->name,
                'id_departemen'  => $faker->numberBetween(1, 5),
                'email' => $faker->unique()->safeEmail,
                'telepon'  => $faker->numberBetween(12345678, 99999999),
                'gender'  => $faker->numberBetween(0, 1),
                'gaji_pokok'  => $faker->numberBetween(1000000, 10000000),
                'status' => $faker->numberBetween(0, 1)
            ]);
        }
    }
}