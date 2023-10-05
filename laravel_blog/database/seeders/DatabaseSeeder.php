<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = collect();
        for ($i = 1; $i <= 10; $i++){
            $users -> add(
                User::factory()->create([
                    'email' => 'user'.$i.'@szerveroldali.hu'
                ])
            );
        }

        $posts = collect();
        for ($i = 1; $i <= 10; $i++){
            $posts -> add(
                Post::factory()->create([
                    'author_id' => $users -> random()
                ])
            );
        }

        // TODO: N-N (post-tag)
        for ($i = 1; $i <= 5; $i++){
            $tag = Tag::factory() -> create();
            $tag -> posts() -> sync(
                $posts -> random( rand(1, $posts -> count()) ) -> pluck('id')
            );
        }
    }
}
