\# Session 05 - Défi : articles récents sur l'accueil



\## Vérification du défi



\- \[x] `latestPosts` contient au plus 3 articles.

\- \[x] Seuls les articles publiés sont transmis à la vue.

\- \[x] `home.blade.php` utilise `x-post-card` et `@forelse`.

\- \[x] Le test vérifie que les brouillons ne s'affichent pas sur l'accueil.

\- \[x] Le test passe avec succès.



\## Pourquoi `get()` et pas `paginate(3)` sur la page d'accueil ?



La méthode `get()` récupère les articles sélectionnés par la requête. Ici, `take(3)` limite le résultat à trois articles publiés.



La méthode `paginate(3)` est utile lorsqu'on souhaite afficher les résultats sur plusieurs pages avec des liens de pagination. Sur la page d'accueil, nous voulons seulement afficher les trois articles les plus récents.

