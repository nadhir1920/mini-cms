<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
});
Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'nadhir jlassi',
        'groupe' => 'MDW32',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
});

Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () =>
    'Même résultat, écrit avec une fonction fléchée.'
);