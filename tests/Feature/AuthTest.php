<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

function authRegisterData(array $overrides = []): array
{
    return array_merge([
        'name' => 'Amina Ben Ali',
        'email' => 'amina@example.com',
        'password' => 'motdepasse123',
        'password_confirmation' => 'motdepasse123',
    ], $overrides);
}

it('registers an author with a hashed password and logs them in', function () {
    $this->post(route('register.store'), authRegisterData())
        ->assertRedirect(route('posts.index'));

    $user = User::where('email', 'amina@example.com')->firstOrFail();

    expect($user->role)->toBe('author');
    expect(Hash::check('motdepasse123', $user->password))->toBeTrue();
    $this->assertAuthenticatedAs($user);
});

it('refuses a password that does not match its confirmation', function () {
    $this->post(route('register.store'), authRegisterData(['password_confirmation' => 'autre-mot-de-passe']))
        ->assertSessionHasErrors('password');

    $this->assertGuest();
});

it('logs in with the right password', function () {
    $user = User::factory()->create(['email' => 'amina@example.com']);

    $this->post(route('login.store'), ['email' => 'amina@example.com', 'password' => 'password'])
        ->assertRedirect(route('posts.index'));

    $this->assertAuthenticatedAs($user);
});

it('refuses a wrong password with a neutral message', function () {
    User::factory()->create(['email' => 'amina@example.com']);

    $this->post(route('login.store'), ['email' => 'amina@example.com', 'password' => 'mauvais'])
        ->assertSessionHasErrors([
            'email' => 'Ces identifiants ne correspondent à aucun compte.',
        ]);

    $this->assertGuest();
});

it('logs out and shows a message', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('success', 'Vous êtes déconnecté.');

    $this->assertGuest();
});
