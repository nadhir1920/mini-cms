## État actuel (tag lab-05)

- Validation des articles dans `StorePostRequest` et `UpdatePostRequest` (`$request->validated()`) : plus aucune règle dans le contrôleur.
- Messages flash après création, modification, suppression et publication, affichés par le layout avec `x-alert`.
- Middleware `EnsureSiteIsWritable` (alias `writable`) : avec `SITE_READ_ONLY=true` dans `.env`, les requêtes d'écriture reçoivent une erreur 503.
- Page « Article introuvable » (404) pour un article inexistant, rendue depuis `withExceptions` dans `bootstrap/app.php` ; les autres 404 gardent la page standard.
- Tests Pest : `PostPagesTest`, `PostWriteTest`, `PostRelationsTest`, `PostTaxonomyTest` et `PostFeedbackTest`.

## Routes disponibles

| Méthode | URI | Nom | Action |
|---|---|---|---|
| GET | `/` | `home` | `PageController@home` |
| GET | `/a-propos` | `about` | `PageController@about` |
| GET | `/heure` | `time` | `PageController@time` |
| GET | `/posts` | `posts.index` | `PostController@index` |
| GET | `/posts/archive/{year}` | `posts.archive` | `PostController@archive` |
| GET | `/posts/categorie/{category:slug}` | `posts.category` | `PostController@byCategory` |
| GET | `/posts/tag/{tag:slug}` | `posts.tag` | `PostController@byTag` |
| GET | `/posts/create` | `posts.create` | `PostController@create` |
| POST | `/posts` | `posts.store` | `PostController@store` |
| GET | `/posts/{post}` | `posts.show` | `PostController@show` |
| GET | `/posts/{post}/edit` | `posts.edit` | `PostController@edit` |
| PUT | `/posts/{post}` | `posts.update` | `PostController@update` |
| DELETE | `/posts/{post}` | `posts.destroy` | `PostController@destroy` |
| PATCH | `/posts/{post}/publication` | `posts.publication` | `PostController@togglePublication` |


### Session 08

![Formulaire de modification avec la catégorie et les tags](screenshots/s08-formulaire-relations.png)

![Page des articles d'une catégorie](screenshots/s08-page-categorie.png)

### Session 09

![Page d'un article avec le message flash « Article créé. »](screenshots/s09-message-flash.png)

![Page Article introuvable pour un identifiant inexistant](screenshots/s09-article-introuvable.png)