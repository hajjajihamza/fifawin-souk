# TifawinSouk – Application Web de Gestion de Catalogue

## 📌 Contexte du projet
Dans le cadre de la digitalisation de son activité, **TifawinSouk**, une PME marocaine spécialisée dans le commerce local, souhaite disposer d’une application web permettant :

- Un **back-office** pour l’administrateur afin de gérer les catégories et les produits.
- Une **interface publique minimale** pour permettre aux clients de consulter les catégories et les produits.

Ce projet a pour but de concevoir une application simple, sécurisée et performante pour la gestion d’un catalogue de produits.

---

## 🎯 Objectifs

L’application doit permettre :

### Pour l’administrateur :
- Gérer les catégories (CRUD : Create, Read, Update, Delete).
- Gérer les produits (CRUD).
- Gérer les images des produits.
- Accéder à un back-office sécurisé par authentification.

### Pour les clients :
- Consulter la liste des catégories.
- Voir les produits par catégorie.
- Consulter la fiche détaillée d’un produit.

---

## ⚙️ Fonctionnalités clés

### 🗂 Gestion des catégories (Back-office)
- Création, modification, suppression et affichage.
- Champs :
    - `id`
    - `nom`
    - `slug`
    - `description`

### 📦 Gestion des produits (Back-office)
- Création, modification, suppression et affichage.
- Champs :
    - `id`
    - `nom`
    - `référence`
    - `description_courte`
    - `prix`
    - `stock`
    - `categorie_id`
    - `image` (métadonnées)

### 🌐 Interface publique
- Page liste des catégories.
- Page liste des produits par catégorie (avec pagination simple).
- Page détail d’un produit.

### 🔐 Sécurité & validation
- Authentification sécurisée pour l’accès au back-office (administrateur).
- Validation côté serveur :
    - Champs obligatoires.
    - Format correct pour le prix.
    - Stock ≥ 0.
- Upload basique des images produits via le système de stockage Laravel.
- Notifications UI pour les succès/erreurs (flash messages).

---

## 🛠 Technologies utilisées

- **Framework** : Laravel (version stable)
- **Template Engine** : Blade
- **Base de données** : MySQL / MariaDB
- **Authentification** : Laravel Breeze / UI (ou équivalent)
- **Frontend** :
    - HTML
    - CSS
    - JavaScript (léger, pas de SPA requis)

---

## 📖 User Stories

### Administrateur
- En tant qu’administrateur, je peux me connecter pour accéder au back-office.
- En tant qu’administrateur, je peux créer une catégorie avec un nom et une description.
- En tant qu’administrateur, je peux créer un produit et l’assigner à une catégorie.
- En tant qu’administrateur, je peux modifier ou supprimer une catégorie ou un produit.

### Utilisateur public
- En tant qu’utilisateur, je peux voir la liste des catégories.
- En tant qu’utilisateur, je peux consulter les produits d’une catégorie.
- En tant qu’utilisateur, je peux voir la fiche détaillée d’un produit.

---

## 🚀 Installation du projet

1. Cloner le dépôt :
```bash
git clone https://github.com/votre-organisation/tifawinsouk.git
cd tifawinsouk
