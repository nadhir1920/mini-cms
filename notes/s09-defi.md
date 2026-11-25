# Session 09 - Défi

Le bandeau s'affiche sur toutes les pages quand SITE_READ_ONLY=true : oui
Le bandeau disparaît quand SITE_READ_ONLY=false : oui
La page Article introuvable propose au plus trois articles publiés, sans brouillon : oui
Aucune LazyLoadingViolationException sur /posts/999 : oui
Les deux nouveaux tests passent et php artisan test est vert : oui

## Pourquoi le bandeau est-il dans le layout et pas dans chaque vue ?

Le composant `x-layout` enveloppe toutes les pages publiques de l'application. Placer le bandeau une seule fois dans le layout évite toute duplication de code et garantit qu'il s'affiche uniformément sur chaque page dès que `config('site.read_only')` vaut `true`.

## Pourquoi le test du bandeau n'a-t-il pas besoin de modifier .env ?

Dans un test Pest/Laravel, `config(['site.read_only' => true])` modifie la configuration en mémoire uniquement pour la durée du test en cours. Cela permet de tester le comportement du bandeau de manière isolée et rapide sans toucher au fichier `.env` réel du projet.
