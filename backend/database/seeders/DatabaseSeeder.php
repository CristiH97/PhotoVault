<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Album;
use App\Models\Photo;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->has(
                Album::factory()
                    ->count(5)
                    ->has(
                        Photo::factory()->count(10)->state(function (array $attributes, Album $album) {
                            return [
                                'uploader_id' => $album->owner_id,       // set uploader to album owner
                                'uploader_name' => $album->owner->name,  // set uploader_name
                            ];
                        }),
                        'photos'
                    ),
                'ownedAlbums'
            )
            ->create();

        $users = User::all();

        foreach ($users as $user) {
            foreach ($user->ownedAlbums as $album) {
                $sharedUsers = $users->where('id', '!=', $user->id)->random(2);
                $album->sharedUsers()->attach($sharedUsers->pluck('id'));
            }
        }
    }
}
