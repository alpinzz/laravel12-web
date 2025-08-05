<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $division = [
            ['name' => 'BPH', 'slug' => 'bph'],
            ['name' => 'Bidang Organisasi', 'slug' => 'organisasi'],
            ['name' => 'Bidang Kader', 'slug' => 'kader'],
            ['name' => 'Bidang Hikmah', 'slug' => 'hikmah'],
            ['name' => 'Bidang RPK', 'slug' => 'rpk'],
            ['name' => 'Bidang Olahraga dan Kepemudaan', 'slug' => 'olahraga'],
            ['name' => 'Bidang Medkom', 'slug' => 'medkom'],
            ['name' => 'Bidang TKK', 'slug' => 'tkk'],
        ];

        foreach ($division as $divisi) {
            Divisi::create($divisi);
        }
    }
}
