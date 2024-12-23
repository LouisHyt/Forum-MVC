# Application MVC Forum

## 📋 Contexte du projet
Dans le cadre de votre formation en développement web, vous devez créer une application type forum en respectant une architecture MVC et en utilisant le framework fourni. Ce projet permet de mettre en pratique l'interaction entre le frontend et le backend, l'authentification, ainsi que la communication avec une base de donnée.

## 🎯 Objectifs pédagogiques
### Consignes
- Structurer les données en réalisant un MCD et un MLD
- Créer et remplir une base de donnée en conséquence
- Réaliser un mockup et des wireframes de l'application pour les vues principales
- Concevoir l'application web en PHP en respectant une architecture Modèles/Vues/Controlleurs et en se basant sur le framework fourni

### Critères de performance
- Code structuré selon le pattern MVC
- Validation des données côté client ET serveur
- Sécurisation des requêtes SQL (requêtes préparées)
- Code commenté et indenté
- Gestion de l'authentification et des permissions

## 🔧 Technologies utilisées
### Languages
- HTML
- CSS
- JavaScript
- PHP
- SQL

### Outils
- Looping
- Figma
- Visual Studio Code
- Laragon
- Git/GitHub
- HeidiSQL

## 💡 Concepts clés abordés
- **HTML/CSS**
  - Sémantique HTML
  - Gestion des formulaires
  - Responsive Design
  
- **PHP**
  - POO
  - PDO et requêtes préparées
  - Sessions
  - Architecture MVC
  - Authentification
  - Server Side Rendering
  - Injection des données dans le HTML
  - Hashage des mots de passes
  
- **SQL**
  - CRUD
  - Jointures
  - Views
  - Clés étrangères
  - Empêcher les Injections SQL
  - Pré-formattage des données

## 📦 Installation et configuration
```bash
# Cloner le repository
git clone https://github.com/LouisHyt/Forum-MVC.git
cd Forum-MVC/php

# Configuration de la base de données
1. Démarrer Laragon (Apache et MySQL)
2. Accéder à HeidiSQL
3. Créer une nouvelle base de données 'exo_forum'
4. Importer le fichier sql/import_database.sql

# Configuration du projet
1. Modifier les informations de connexion dans model/connect.php:
   
```

## 🚀 Structure du projet
```
Cinema-MVC/
├── app/                  # Dossier principal de l'application
│   ├── controller/       # Contrôleurs de l'application
│   ├── model/            # Modèles de données
│   ├── view/             # Vues de l'application
│   ├── services/         # Services utilitaires
│   ├── public/           # Ressources publiques (CSS, JS, images)
│   └── index.php         # Point d'entrée de l'application
├── figma/                # Maquettes et designs Figma
├── mcd/                  # Modèle Conceptuel et logique des données
└── sql/                  # Scripts d'importation & autre
```

## ✨ Démonstration
### MCD & MLD
- Modèle Relationnel des données : ![Schéma Looping du model relationnel des données](/MCD-MLD/mc.jpg)
  
- Modèle Logique des données : ![Schéma Looping du model Logique des données](/MCD-MLD/ml.jpg)


## 🏆 Compétences visées
- Développer une application web complète
- Mettre en place une architecture MVC
- Gérer les interactions utilisateur
- Sécuriser et vérifier les données stockées
- Gérer l'authentification et les permissions utilisateurs
- Manipuler une base de données
- Sécuriser une application web

---
Exercice réalisé dans le cadre de la formation Développeur Web Full Stack au sein d'Elan Formation
- 📅 Date : Décembre 2024
- ✍️ Auteur : Louis Hayotte
