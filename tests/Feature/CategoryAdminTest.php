<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

function categoryAdminData(array $overrides = []): array
{
    return array_merge([
        'name' => 'Cuisine',
        'slug' => 'cuisine',
    ], $overrides);
}

it('lists the categories', function () {
    Category::factory()->create(['name' => 'Cuisine', 'slug' => 'cuisine']);

    $this->get(route('admin.categories.index'))
        ->assertOk()
        ->assertSee('Cuisine');
});

it('creates a category and flashes a message', function () {
    $this->post(route('admin.categories.store'), categoryAdminData())
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHas('success', 'Catégorie créée.');

    $this->assertDatabaseHas('categories', ['name' => 'Cuisine', 'slug' => 'cuisine']);
});

it('rejects an empty category with French messages', function () {
    $this->post(route('admin.categories.store'), ['name' => '', 'slug' => ''])
        ->assertSessionHasErrors([
            'name' => 'Le champ nom est obligatoire.',
            'slug' => 'Le champ slug est obligatoire.',
        ]);

    $this->assertDatabaseCount('categories', 0);
});

it('rejects a slug already used by another category', function () {
    Category::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);

    $this->post(route('admin.categories.store'), categoryAdminData(['name' => 'Autre', 'slug' => 'laravel']))
        ->assertSessionHasErrors([
            'slug' => 'Ce slug est déjà utilisé par une autre catégorie.',
        ]);
});

it('keeps its own slug on update', function () {
    $category = Category::factory()->create(['name' => 'Cuisine', 'slug' => 'cuisine']);

    $this->put(route('admin.categories.update', $category), ['name' => 'Cuisine du monde', 'slug' => 'cuisine'])
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success', 'Catégorie mise à jour.');

    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Cuisine du monde', 'slug' => 'cuisine']);
});

it('deletes a category and keeps its posts', function () {
    $category = Category::factory()->create();
    $post = Post::factory()->for($category)->create();

    $this->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHas('success', 'Catégorie supprimée.');

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'category_id' => null]);
});

it('blocks category writes when the site is read-only', function () {
    config(['site.read_only' => true]);

    $this->post(route('admin.categories.store'), categoryAdminData())
        ->assertStatus(503)
        ->assertSee('Le site est en lecture seule.');

    $this->assertDatabaseCount('categories', 0);
});

it('still shows the category list when the site is read-only', function () {
    config(['site.read_only' => true]);

    $this->get(route('admin.categories.index'))
        ->assertOk();
});
