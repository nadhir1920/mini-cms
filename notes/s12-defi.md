# Session 12 - Défi

1. Pourquoi `role` n'est-il pas dans `#[Fillable]`, et comment votre contrôleur le modifie-t-il quand même ?

Le contrôleur d'inscription ne passe que `name`, `email` et `password` à `create()`. En gardant `role` hors de `#[Fillable]`, le champ reste protégé contre l'assignation de masse même si un contrôleur utilise `$request->all()` ou si une règle `role` est ajoutée à une Form Request. Dans `UserController::updateRole()`, le contrôleur affecte directement `$user->role = $request->validated('role');` après vérification de la policy `UserPolicy::changeRole`, puis appelle `$user->save()`.

2. Pourquoi le callback de `Gate::before` doit-il renvoyer `null`, et non `false`, pour un auteur ?

`false` est un refus définitif qui empêcherait Laravel d'interroger les Gates et Policies suivants : un auteur ne pourrait même plus modifier ses propres articles. Renvoyer `null` signifie « pas d'avis » : Laravel continue normalement et délègue la décision au Gate ou à la méthode de la Policy concernée.
