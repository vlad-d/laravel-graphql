<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $artists = factory(\App\Models\Artist::class, rand(8, 12))->create();

        foreach (array_chunk($artists->toArray(), 3) as $chunkArtists) {
            $mainArtist = $chunkArtists[0];
            $album = factory(\App\Models\Album::class)->create([
                'main_artist_id' => $mainArtist['id']
            ]);

            factory(\App\Models\Song::class, rand(4, 12))
                ->create([
                    'album_id' => $album->id
                ])
                ->each(function (\App\Models\Song $song) use ($chunkArtists, $mainArtist) {
                    $song->artists()->attach($mainArtist['id']);
                    if ($song->id % 3 === 0 && !empty($chunkArtists[1])) {
                        $song->artists()->attach($chunkArtists[1]['id']);
                    }

                    if ($song->id % 6 === 0 && !empty($chunkArtists[2])) {
                        $song->artists()->attach($chunkArtists[2]['id']);
                    }
                });
        }
    }
}
