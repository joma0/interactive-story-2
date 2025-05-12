<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Histoires interactives

Ce projet est une application web qui propose des histoires interactives. L’utilisateur peut choisir une histoire, et la parcourir en faisant des choix à chaque étape. Ses choix le guideront, ou non, vers un dénouement heureux.

## Fonctionnalités principales

-   Affichage de toutes les histoires disponibles
-   Lecture interactive avec choix multiples par chapitre
-   Système d’authentification simple (backend)
-   Page profil protégée nécessitant une connexion
-   Réactivité grâce à Vue.js

## Technologies utilisées

-   **Backend** : Laravel 12
-   **Frontend** : Vue
-   **Base de données** : SQLite
-   **API** : Laravel API avec middleware `auth:sanctum`
-   **Visuel** : Tailwind CSS

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/ton-utilisateur/interactive-story.git
cd interactive-story
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Créer un fichier d'environnement

```bash
cp .env.example .env
```

Dans le fichier d'environnement, configurer la base de données :

```ini
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/vers/database.sqlite
```

### 5. Générer la clé de l'application

```bash
php artisan key:generate
```

### 6. Exécuter les migrations

```bash
php artisan migrate
```

### 7. Lancer les deux serveurs (Vite Dev Server et Laravel Development Server)

```bash
composer run dev
```

Ou les deux serveurs séparément

Pour Laravel Development Server :

```bash
php artisan serve
```

Pour Vite Dev Server

```bash
npm run dev
```
