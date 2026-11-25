<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

function authorizationPostData(array $overrides = []): array
{
    return array_merge([
        'title' => 'Article autorisé',
        'slug' => 'article-autorise',
        'body' => 'Contenu assez long pour passer la validation.',
        'is_published' => '1',
    ], $overrides);
}

it('redirects a guest to the login page', function () {
    $this->get(route('posts.create'))
        ->assertRedirect(route('login'));
});

it('records the logged-in user as the author', function () {
    $author = User::factory()->create();

    $this->actingAs($author)
        ->post(route('posts.store'), authorizationPostData())
        ->assertRedirect();

    $post = Post::where('slug', 'article-autorise')->firstOrFail();
    expect($post->user_id)->toBe($author->id);
});

it('lets an author edit their own post', function () {
    $author = User::factory()->create();
    $post = Post::factory()->for($author)->create();

    $this->actingAs($author)
        ->get(route('posts.edit', $post))
        ->assertOk();
});

it('forbids an author to edit the post of another user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($other)
        ->get(route('posts.edit', $post))
        ->assertForbidden();
});

it('forbids an author to update the post of another user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $post = Post::factory()->for($owner)->create(['title' => 'Titre initial']);

    $this->actingAs($other)
        ->put(route('posts.update', $post), authorizationPostData(['title' => 'Titre modifié']))
        ->assertForbidden();

    expect($post->fresh()->title)->toBe('Titre initial');
});

it('forbids an author to delete the post of another user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($other)
        ->delete(route('posts.destroy', $post))
        ->assertForbidden();

    $this->assertDatabaseHas('posts', ['id' => $post->id]);
});

it('lets an admin update any post', function () {
    $owner = User::factory()->create();
    $admin = User::factory()->admin()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($admin)
        ->put(route('posts.update', $post), authorizationPostData(['title' => 'Modifié par admin']))
        ->assertRedirect(route('posts.show', $post));

    expect($post->fresh()->title)->toBe('Modifié par admin');
});

it('keeps the category back office for admins', function () {
    $author = User::factory()->create();
    $admin = User::factory()->admin()->create();

    $this->actingAs($author)
        ->get(route('admin.categories.index'))
        ->assertForbidden();

    $this->actingAs($admin)
        ->get(route('admin.categories.index'))
        ->assertOk();
});

it('shows only the logged-in user posts on my-posts', function () {
    $author = User::factory()->create();
    $other = User::factory()->create();

    $myPost = Post::factory()->for($author)->create(['title' => 'Mon article prive', 'is_published' => false, 'published_at' => null]);
    $otherPost = Post::factory()->for($other)->published()->create(['title' => 'Article dun autre']);

    $this->actingAs($author)
        ->get(route('my-posts'))
        ->assertOk()
        ->assertSee($myPost->title)
        ->assertDontSee($otherPost->title);
});

it('redirects a guest from my-posts to login', function () {
    $this->get(route('my-posts'))
        ->assertRedirect(route('login'));
});
