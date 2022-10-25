# Openclassrooms P5 Créez votre premier blog en PHP

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/f45354dac9734da290d39756d0296b0a)](https://www.codacy.com/gh/Phil4525/P5_myBlog/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Phil4525/P5_myBlog&amp;utm_campaign=Badge_Grade)

Projet n°5 du parcours OpenClassrooms "Développeur d'application PHP/Symfony" : création d'un Blog en PHP en utilisant une architecture MVC et Orienté objet.

### Configuration

- PHP 8.1.9
- Apache 2.4.47
- mySQL 5.7.33

### Installation

- Cloner le depôt dans le dossier racine de votre serveur local
- Importer le fichier p5_myblog.sql dans votre base de données
- Ouvrir le fichier P5_myBlog/src/lib/DatabaseConnection.php et y insérer vos identifiants à la ligne 12:
    `$this->database = new \PDO('mysql:host=localhost;dbname=p5_myblog;charset=utf8', 'username', 'password');`
- Ouvrir une fenêtre de terminal et y taper "composer install" pour mettre en place l'autoloader de Composer

## Démarrage

Dites comment faire pour lancer votre projet

## Fabriqué avec

Entrez les programmes/logiciels/ressources que vous avez utilisé pour développer votre projet

_exemples :_
* [Materialize.css](http://materializecss.com) - Framework CSS (front-end)
* [Atom](https://atom.io/) - Editeur de textes

## Contributing

Si vous souhaitez contribuer, lisez le fichier [CONTRIBUTING.md](https://example.org) pour savoir comment le faire.

## Versions
Listez les versions ici 
_exemple :_
**Dernière version stable :** 5.0
**Dernière version :** 5.1
Liste des versions : [Cliquer pour afficher](https://github.com/your/project-name/tags)
_(pour le lien mettez simplement l'URL de votre projets suivi de ``/tags``)_

## Auteurs
Listez le(s) auteur(s) du projet ici !
* **Jhon doe** _alias_ [@outout14](https://github.com/outout14)

Lisez la liste des [contributeurs](https://github.com/your/project/contributors) pour voir qui à aidé au projet !

_(pour le lien mettez simplement l'URL de votre projet suivi de ``/contirubors``)_

## License

Ce projet est sous licence ``exemple: WTFTPL`` - voir le fichier [LICENSE.md](LICENSE.md) pour plus d'informations
