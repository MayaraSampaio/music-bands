<?php

namespace Database\Seeders;
use App\Models\Band;
use App\Models\Album;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($band = Band::where('name', 'Metallica')->first()) {

            Album::updateOrCreate(
                ['name' => 'Master of Puppets'],
                [
                    'released_at' => '1986-03-03',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );

            Album::updateOrCreate(
                ['name' => 'Ride the Lightning'],
                [
                    'released_at' => '1984-07-27',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );
        }

        if ($band = Band::where('name', 'Nirvana')->first()) {

            Album::updateOrCreate(
                ['name' => 'Nevermind'],
                [
                    'released_at' => '1991-09-24',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );

            Album::updateOrCreate(
                ['name' => 'In Utero'],
                [
                    'released_at' => '1993-09-13',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );
        }
        if ($band = Band::where('name', 'Pink Floyd')->first()) {

            Album::updateOrCreate(
                ['name' => 'The Dark Side of the Moon'],
                [
                    'released_at' => '1973-03-01',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );

            Album::updateOrCreate(
                ['name' => 'The Wall'],
                [
                    'released_at' => '1979-11-30',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );
        }
        if ($band = Band::where('name', 'Queen')->first()) {

            Album::updateOrCreate(
                ['name' => 'A Night at the Opera'],
                [
                    'released_at' => '1975-11-21',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );

            Album::updateOrCreate(
                ['name' => 'News of the World'],
                [
                    'released_at' => '1977-10-28',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );
        }
        if ($band = Band::where('name', 'The Beatles')->first()) {

            Album::updateOrCreate(
                ['name' => 'Abbey Road'],
                [
                    'released_at' => '1969-09-26',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );

            Album::updateOrCreate(
                ['name' => 'Sgt. Pepper\'s Lonely Hearts Club Band'],
                [
                    'released_at' => '1967-05-26',
                    'band_id' => $band->id,
                    'image' => null,
                ]
            );
        }
    }
}
