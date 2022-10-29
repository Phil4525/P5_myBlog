# Openclassrooms P5 Créez votre premier blog en PHP

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/f45354dac9734da290d39756d0296b0a)](https://www.codacy.com/gh/Phil4525/P5_myBlog/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Phil4525/P5_myBlog&amp;utm_campaign=Badge_Grade)

Projet n°5 du parcours OpenClassrooms "Développeur d'application PHP/Symfony" : création d'un Blog en PHP en utilisant une architecture MVC et Orienté objet.

## Configuration du projet

- PHP 8.1.9
- Apache 2.4.47
- mySQL 5.7.33

## Installation

- Cloner le depôt dans le dossier racine de votre serveur local
- Importer le fichier mySQL/p5_myblog.sql dans votre base de données
- Ouvrir le fichier P5_myBlog/src/lib/DatabaseConnection.php et y insérer vos identifiants à la ligne 12:
    `$this->database = new \PDO('mysql:host=localhost;dbname=p5_myblog;charset=utf8', 'username', 'password');`
- Ouvrir une fenêtre de terminal et y taper "composer install" pour mettre en place l'autoloader de Composer

## Connexion à l'interface d'administration

email: "admin@myblog.fr", password:"admin"

## Fabriqué avec

- Bootsrap 5.1.3
- Thème: Freelancer de Start Bootstrap: https://startbootstrap.com/theme/freelancer 

