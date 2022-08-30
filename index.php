<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/blog.php');
require_once('src/controllers/post.php');
require_once('src/controllers/admin.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'homepage') {
        homepage();
    } else if ($_GET['action'] === 'blog') {
        blog();
    } else if ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id = $_GET['id'];

            post($id);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';

            die;
        }
    } else if ($_GET['action'] === 'admin') {
        admin();
    } else {
        echo "Erreur 404 : la page que vous recherchez n'existe pas.";
    }
} else {
    homepage();
}
