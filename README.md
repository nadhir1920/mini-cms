# Mini-CMS — Atelier Framework Côté Serveur

Projet Laravel réalisé dans le cadre de l'Atelier Framework Côté Serveur.

## État actuel (tag lab-02)

- Routes nommées pour les pages et les articles.
- Contrôleurs `PageController` et `PostController`.
- Articles stockés dans un tableau PHP, sans base de données pour l'instant.
- Layout Blade `<x-layout>` avec Tailwind chargé par Vite.
- Page d'accueil, page À propos et page Heure du serveur.
- Page des articles, détail d'un article et archives par année.

## Routes disponibles

| Méthode | URI | Nom | Action |
|---|---|---|---|
| GET | `/` | `home` | `PageController@home` |
| GET | `/a-propos` | `about` | `PageController@about` |
| GET | `/heure` | `time` | `PageController@time` |
| GET | `/posts` | `posts.index` | `PostController@index` |
| GET | `/posts/archive/{year}` | `posts.archive` | `PostController@archive` |
| GET | `/posts/{slug}` | `posts.show` | `PostController@show` |

## Captures d'écran

### Page d'accueil avec le layout

![Page d'accueil avec le layout](screenshots/s03-accueil.png)

### Liste des articles

![Liste des articles](screenshots/s03-articles.png)

### Détail d'un article

![Détail d'un article](screenshots/s03-article.png)
