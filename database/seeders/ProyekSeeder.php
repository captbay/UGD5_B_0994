<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProyekSeeder extends Seeder
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
            DB::table('proyeks')->insert([
                'nama_proyek' => $faker->name,
                'id_departemen'  => $faker->numberBetween(1, 5),
                'waktu_mulai' => $faker->unique()->date('Y-m-d'),
                'waktu_selesai' => $faker->unique()->date('Y-m-d'),
                'nilai_proyek'  => $faker->numberBetween(1000000, 10000000),
                'status' => $faker->numberBetween(0, 1)
            ]);
        }
    }
}