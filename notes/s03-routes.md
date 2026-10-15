# Session 03 - Routes, contrôleurs et layout

## Défi

**URL produite par `route('about')` :**

`http://localhost:8000/a-propos`

**URL produite par `route('posts.show', 'routes-et-controleurs')` :**

`http://localhost:8000/posts/routes-et-controleurs`

**URL produite par `route('posts.archive', 2025)` :**

`http://localhost:8000/posts/archive/2025`

**Pourquoi `/posts/archive/abc` et `/posts/article-inconnu` répondent toutes deux 404, et quelle ligne de code en est responsable dans chaque cas ?**

- `/posts/archive/abc` : la contrainte `whereNumber('year')` dans `routes/web.php` refuse une année non numérique.
- `/posts/article-inconnu` : `PostController::show` déclenche `abort(404)` si aucun article ne correspond au slug demandé.

**Que se passe-t-il si une vue appelle `route('posts.show')` sans paramètre ?**

Laravel déclenche une exception `Missing required parameter`, car la route `posts.show` exige un paramètre `slug`.
