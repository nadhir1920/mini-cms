<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        if (
            $users->isEmpty()
            || $categories->isEmpty()
            || $tags->isEmpty()
        ) {
            throw new \RuntimeException(
                'Seed users, categories and tags before running PostSeeder.'
            );
        }

        $posts = Post::factory()
            ->count(9)
            ->published()
            ->recycle($users)
            ->recycle($categories)
            ->create();

        $drafts = Post::factory()
            ->count(3)
            ->state([
                'is_published' => false,
                'published_at' => null,
            ])
            ->recycle($users)
            ->recycle($categories)
            ->create();

        $posts = $posts->concat($drafts);

        foreach ($posts as $post) {
            $post->tags()->sync(
                $tags->random(min(2, $tags->count()))->modelKeys()
            );
        }
    }
}
