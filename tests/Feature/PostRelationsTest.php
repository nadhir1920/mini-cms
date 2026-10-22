<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a post belongs to a user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    expect($post->user->id)->toBe($user->id);
});

test('a post belongs to a category', function () {
    $category = Category::factory()->create();
    $post = Post::factory()->for($category)->create();

    expect($post->category->id)->toBe($category->id);
});

test('a category has many posts', function () {
    $category = Category::factory()->create();
    Post::factory()->count(3)->for($category)->create();

    expect($category->posts)->toHaveCount(3);
});

test('a user has many posts', function () {
    $user = User::factory()->create();
    Post::factory()->count(3)->for($user)->create();

    expect($user->posts)->toHaveCount(3);
});

test('a post can have many tags', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory()->count(2)->create();

    $post->tags()->sync($tags->modelKeys());

    expect($post->tags)->toHaveCount(2);
});

test('deleting a category keeps its posts and sets category id to null', function () {
    $category = Category::factory()->create();
    $post = Post::factory()->for($category)->create();

    $category->delete();

    expect($post->fresh()->category_id)->toBeNull();
});

test('deleting a post removes its pivot tag associations', function () {
    $post = Post::factory()->create();
    $tag = Tag::factory()->create();

    $post->tags()->attach($tag);

    $post->delete();

    expect(
        DB::table('post_tag')
            ->where('post_id', $post->id)
            ->count()
    )->toBe(0);
});

test('a post page shows up to three other published posts from the same category', function () {
    $category = Category::factory()->create();

    $currentPost = Post::factory()->published()->for($category)->create();

    $relatedPosts = Post::factory()
        ->count(4)
        ->published()
        ->for($category)
        ->create();

    $draft = Post::factory()
        ->state(['is_published' => false, 'published_at' => null])
        ->for($category)
        ->create();

    $response = $this->get(route('posts.show', $currentPost));

    $response->assertOk();

    foreach ($relatedPosts->take(3) as $relatedPost) {
        $response->assertSee($relatedPost->title);
    }

    $response->assertDontSee($draft->title);
});
