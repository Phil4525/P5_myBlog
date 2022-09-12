<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/blog.php');
require_once('src/controllers/post.php');
require_once('src/controllers/admin/homepage.php');
require_once('src/controllers/admin/post.php');
require_once('src/controllers/admin/new_post.php');
require_once('src/controllers/admin/add_post.php');
require_once('src/controllers/admin/view_post.php');
require_once('src/controllers/admin/update_post.php');
require_once('src/controllers/admin/delete_post.php');
require_once('src/controllers/admin/comment.php');
require_once('src/controllers/admin/view_comment.php');
require_once('src/controllers/admin/user.php');
require_once('src/controllers/admin/view_user.php');
require_once('src/controllers/admin/delete_user.php');
require_once('src/controllers/admin/contact.php');
require_once('src/controllers/admin/view_contact.php');
require_once('src/controllers/admin/delete_contact.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/update_comment.php');
require_once('src/controllers/delete_comment.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');
require_once('src/controllers/register.php');
require_once('src/controllers/password.php');
require_once('src/controllers/contact.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'homepage') {

            homepage();
        } elseif ($_GET['action'] === 'blog') {

            blog();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                post($id);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_SESSION['user'])) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $id = $_GET['id'];

                    addComment($id, $_POST);
                } else {
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            } else {
                throw new Exception('Vous devez être connecté pour laisser un commentaire');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                modifyComment($id, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                commentSuppression($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'login') {

            login($_POST);
        } elseif ($_GET['action'] === 'logout') {

            logout();
        } elseif ($_GET['action'] === 'register') {

            register($_POST);
        } elseif ($_GET['action'] === 'password') {

            password();
        } elseif ($_GET['action'] === 'contact') {

            contact($_POST);
        } elseif ($_GET['action'] === 'adminHomepage') {

            adminHomepage();
        } elseif ($_GET['action'] === 'adminPosts') {

            adminGetPosts();
        } elseif ($_GET['action'] === 'newPost') {

            newPost();
        } elseif ($_GET['action'] === 'addPost') {

            addPost($_POST);
        } elseif ($_GET['action'] === 'viewPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                viewPost($id);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé");
            }
        } elseif ($_GET['action'] === 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                modifyPost($id, $input);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé");
            }
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                postSuppression($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'adminComments') {

            adminGetComments();
        } elseif ($_GET['action'] === 'viewComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                viewComment($id);
            } else {
                throw new Exception("Aucun identifiant de commentaire envoyé");
            }
        } elseif ($_GET['action'] === 'adminUsers') {

            adminGetUsers();
        } elseif ($_GET['action'] === 'viewUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                viewUser($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé");
            }
        } elseif ($_GET['action'] === 'deleteUser') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                userSuppression($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé");
            }
        } elseif ($_GET['action'] === 'adminContacts') {

            adminGetContacts();
        } elseif ($_GET['action'] === 'viewContact') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                viewContact($id);
            } else {
                throw new Exception("Aucun identifiant de message envoyé");
            }
        } elseif ($_GET['action'] === 'deleteContact') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];

                contactSuppression($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé");
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        homepage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('templates/error.php');
}
