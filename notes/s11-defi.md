# Session 11 - Défi : mes articles et se souvenir de moi

## Vérification du défi

- [x] Niveau 1 : Route `GET /mes-articles` (`my-posts`) protégée par `auth`, affichant uniquement les articles (brouillons inclus) de l'utilisateur connecté avec chargement anticipé.
- [x] Niveau 1 : Lien « Mes articles » dans la barre de navigation pour les utilisateurs connectés.
- [x] Niveau 2 : Case « Se souvenir de moi » (`name="remember"`) sur la page de connexion, passée en second argument à `Auth::attempt(...)`.
- [x] Niveau 3 : 2 nouveaux tests dans `AuthorizationTest` vérifiant `/mes-articles` (utilisateur connecté vs invité).
- [x] Tous les tests Pest (`AuthTest`, `AuthorizationTest` et les suites existantes) passent.
