# Session 08 - Défi : pages par tag et tags populaires

## Vérification du défi

- [x] Niveau 1 : La route `posts.tag` (`/posts/tag/{tag:slug}`) affiche les articles publiés d'un tag, paginés par 4, avec chargement anticipé.
- [x] Niveau 1 : Les badges de tags dans `x-post-card` sont des liens cliquables vers la page du tag.
- [x] Niveau 2 : `PageController@home` charge les tags avec `withCount` (uniquement les articles publiés), triés par popularité puis par nom, et filtre ceux sans article publié.
- [x] Niveau 2 : `home.blade.php` affiche la section « Tags populaires » uniquement s'il y en a au moins un.
- [x] Niveau 3 : Les 3 tests de `PostTaxonomyTest` pour les tags et tags populaires passent avec succès.

## Questions de réflexion

### 1. Pourquoi ne pas afficher les tags qui n'ont aucun article publié sur la page d'accueil, et pourquoi filtrer après `get()` ?

Afficher un tag avec un compteur `(0)` mènerait l'utilisateur vers une page vide, ce qui nuit à l'expérience utilisateur. Filtrer la collection en PHP après `get()` (`->filter(fn (Tag $tag) => $tag->posts_count > 0)`) évite d'ajouter une clause `HAVING` ou `WHERE EXISTS` supplémentaire en SQL tout en réutilisant directement le `posts_count` déjà calculé par `withCount`.

### 2. Combien de requêtes SQL supplémentaires `withCount` ajoute-t-il pour compter tous les tags ?

`withCount` n'ajoute aucune requête supplémentaire séparée par tag (pas de problème N+1) : Eloquent intègre le comptage directement dans la requête `SELECT` principale des tags via une sous-requête corrélée (`(select count(*) from ...)`), ce qui permet de récupérer tous les tags et leurs compteurs en une seule requête.
