<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    private function posts(): array
    {
        return [
            [
                'slug' => 'decouvrir-laravel-13',
                'title' => 'Découvrir Laravel 13',
                'year' => 2026,
                'content' => 'Découvrez les bases de Laravel 13 et la structure du projet.',
            ],
            [
                'slug' => 'routes-et-controleurs',
                'title' => 'Routes et contrôleurs',
                'year' => 2026,
                'content' => 'Les routes définissent les URL et les contrôleurs organisent la logique de l’application.',
            ],
            [
                'slug' => 'premiers-pas-avec-blade',
                'title' => 'Premiers pas avec Blade',
                'year' => 2025,
                'content' => 'Blade permet de créer des vues réutilisables avec Laravel.',
            ],
        ];
    }

    public function index()
    {
        return view('posts.index', [
            'posts' => $this->posts(),
        ]);
    }

    public function show(string $slug)
    {
        $post = collect($this->posts())->firstWhere('slug', $slug);

        abort_if($post === null, 404);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function archive(string $year)
    {
        $posts = collect($this->posts())
            ->where('year', (int) $year)
            ->values();

        return view('posts.archive', [
            'year' => $year,
            'posts' => $posts,
        ]);
    }
}