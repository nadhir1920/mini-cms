# Session 02 — Git

## 1. Configuration de Git

```bash
git config --global user.name "nadhir1920"
git config --global user.email "nadhirjlassi94@gmail.com"
```

## 2. Initialisation et suivi des fichiers

```bash
git init
git status
git add .
git commit -m "message"
```

## 3. Historique des commits

```bash
git log --oneline --decorate
git log --oneline --all --graph
```

## 4. Branches

```bash
git branch
git branch -M main
```

## 5. Tags

```bash
git tag lab-01
git tag -f lab-01 HASH
```

## 6. Dépôt distant GitHub

```bash
git remote -v
git remote add origin URL
git push -u origin main
```

## 7. Fichiers ignorés

Le fichier `.gitignore` permet d'exclure certains fichiers et dossiers du suivi Git, comme `.env`, `vendor` et `node_modules`.

## 8. Bonnes pratiques

- Vérifier l'état du dépôt avec `git status`.
- Créer des commits avec des messages clairs.
- Vérifier l'historique avant de publier.
- Ne pas réécrire l'historique après le premier push, sauf consigne explicite.
## 6. Historique depuis lab-01

Nombre de commits depuis lab-01 : 6

Fichiers modifiés depuis lab-01 : README.md, notes/s02-git.md, resources/views/a-propos.blade.php, routes/web.php, screenshots/s02-a-propos.png

Ce que git tag -n affiche pour lab-01 : lab-01