<?php

namespace Database\Seeders;
use App\Models\Band;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Band::create([
        'name' => 'Metallica',
        'photo' => 'images/metalica.png',
    ]);
    Band::create([
        'name' => 'Nirvana',
        'photo' => 'images/nirvana.png',
    ]);
    Band::create([
        'name' => 'Pink Floyd',
        'photo' => 'images/pinkfloyd.png',
    ]);

    Band::create([
        'name' => 'Queen',
        'photo' => 'images/queen.png',
    ]);
    Band::create([
        'name' => 'The Beatles',
        'photo' => 'images/beatles.png',
    ]);

    }
}
