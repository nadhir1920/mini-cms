# Session 10 - Défi : tests des tags et page catégorie introuvable

## Vérification du défi

- [x] `TagAdminTest` contient 5 tests (création + flash, champs vides en français, slug en doublon, blocage 503, lecture seule OK en GET).
- [x] `StoreTagRequest` et `UpdateTagRequest` définissent `messages()` pour `slug.unique`.
- [x] `bootstrap/app.php` rend `errors.categorie-introuvable` (404) quand une `Category` est introuvable, tout en gardant `errors.article-introuvable` pour `Post` et le JSON pour `/api/*`.
- [x] `ErrorPagesTest` vérifie `/posts/categorie/inconnue` (`Catégorie introuvable`).
- [x] Tous les tests Pest (`CategoryAdminTest`, `TagAdminTest`, `ErrorPagesTest` et les suites existantes) passent.

## Questions de réflexion

### 1. Pourquoi `messages()` dans un Form Request a-t-il priorité sur `lang/fr/validation.php` ?

Laravel résout les messages d'erreur du plus spécifique au plus général : d'abord les messages personnalisés déclarés dans `messages()` de la Form Request (ciblant un champ et une règle précis, comme `slug.unique`), ensuite le fichier de traduction `lang/fr/validation.php` de la locale active, et enfin le repli anglais du framework.

### 2. Pourquoi `phpunit.xml` définit-il `APP_LOCALE=fr` ?

Les tests PHPUnit/Pest n'utilisent pas toujours les mêmes variables d'environnement que `.env` (ou peuvent être exécutés sur une machine / CI sans `.env`). Définir `<env name="APP_LOCALE" value="fr"/>` dans `phpunit.xml` garantit que les tests de validation reçoivent toujours les messages français de façon déterministe.

### 3. Pourquoi `CategoryController` n'a-t-il pas besoin de blocs `try/catch` ?

La validation des entrées est déjà gérée en amont par `StoreCategoryRequest` et `UpdateCategoryRequest` (qui redirigent avec les erreurs avant même d'entrer dans le contrôleur), et les erreurs de modèle introuvable ou d'accès en lecture seule sont gérées de manière centralisée par les middlewares et le gestionnaire d'exceptions (`bootstrap/app.php`).
