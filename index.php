<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use App\Lib\Globals;
use App\Controllers\HomepageController;
use App\Controllers\ListAllPostsController;
use App\Controllers\ShowPostController;
use App\Controllers\SendContactController;
use App\Controllers\SearchController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\SignupController;
use App\Controllers\Auth\PasswordRecoveryController;
use App\Controllers\Auth\ResetPasswordController;
use App\Controllers\Comment\AddCommentController;
use App\Controllers\Comment\UpdateCommentController;
use App\Controllers\Comment\DeleteCommentController;
use App\Controllers\Admin\AdminLoginController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ViewAllPostsController;
use App\Controllers\Admin\ViewPostController;
use App\Controllers\Admin\NewPostController;
use App\Controllers\Admin\AddPostController;
use App\Controllers\Admin\UpdatePostController;
use App\Controllers\Admin\DeletePostController;
use App\Controllers\Admin\ViewAllCommentsController;
use App\Controllers\Admin\ViewCommentController;
use App\Controllers\Admin\ViewAllUsersController;
use App\Controllers\Admin\ViewUserController;
use App\Controllers\Admin\DeleteUserController;
use App\Controllers\Admin\ViewAllContactsController;
use App\Controllers\Admin\viewContactController;
use App\Controllers\Admin\DeleteContactController;

$globals = new Globals();
$get = $globals->getGET();
$post = $globals->getPOST();

try {
    if (isset($get['action']) && $get['action'] !== '') {
        if ($get['action'] === 'homepage') {

            (new HomepageController())->execute();
        } elseif ($get['action'] === 'blog') {

            (new ListAllPostsController())->execute();
        } elseif ($get['action'] === 'post') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new ShowPostController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        } elseif ($get['action'] === 'addComment') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                $parentCommentId = null;
                if (isset($get['parentCommentId']) && $get['parentCommentId'] > 0) {
                    $parentCommentId = strip_tags($get['parentCommentId']);
                }

                (new AddCommentController())->execute($id, $parentCommentId, $post);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }
        } elseif ($get['action'] === 'updateComment') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($globals->getSERVER('REQUEST_METHOD') === 'POST') {
                    $input = $post;
                }
                (new UpdateCommentController())->execute($id, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($get['action'] === 'deleteComment') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new DeleteCommentController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($get['action'] === 'login') {

            (new LoginController())->execute($post);
        } elseif ($get['action'] === 'logout') {

            (new LogoutController())->execute();
        } elseif ($get['action'] === 'signup') {

            (new SignupController())->execute($post);
        } elseif ($get['action'] === 'passwordRecovery') {

            (new PasswordRecoveryController())->execute($post);
        } elseif ($get['action'] === 'resetPassword') {
            if (isset($get['key']) && isset($get['reset'])) {
                $email = $get['key'];
                $password = $get['reset'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($globals->getSERVER('REQUEST_METHOD') === 'POST') {
                    $input = $post;
                }

                (new ResetPasswordController())->execute($email, $password, $input);
            } else {
                throw new Exception("Aucune information d'utilisateur envoyé.");
            }
        } elseif ($get['action'] === 'contact') {

            (new SendContactController())->execute($post);
        } elseif ($get['action'] === 'search') {

            (new SearchController())->execute($post);
        } elseif ($get['action'] === 'adminLogin') {

            (new AdminLoginController())->execute($post);
        } elseif ($get['action'] === 'dashboard') {

            (new DashboardController())->execute();
        } elseif ($get['action'] === 'posts') {

            (new ViewAllPostsController())->execute();
        } elseif ($get['action'] === 'newPost') {

            (new NewPostController())->execute();
        } elseif ($get['action'] === 'addPost') {
            (new AddPostController())->execute($post);
        } elseif ($get['action'] === 'viewPost') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new ViewPostController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé.");
            }
        } elseif ($get['action'] === 'editPost') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($globals->getSERVER('REQUEST_METHOD') === 'POST') {
                    $input = $post;
                }
                (new UpdatePostController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant d'article envoyé.");
            }
        } elseif ($get['action'] === 'deletePost') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new DeletePostController())->execute($id);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé.');
            }
        } elseif ($get['action'] === 'comments') {

            (new ViewAllCommentsController())->execute();
        } elseif ($get['action'] === 'viewComment') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                $input = null;
                if ($globals->getSERVER('REQUEST_METHOD') === 'POST') {
                    $input = $post;
                }

                (new ViewCommentController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant de commentaire envoyé.");
            }
        } elseif ($get['action'] === 'users') {

            (new ViewAllUsersController())->execute();
        } elseif ($get['action'] === 'viewUser') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                $input = null;
                if ($globals->getSERVER('REQUEST_METHOD') === 'POST') {
                    $input = $post;
                }

                (new ViewUserController())->execute($id, $input);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($get['action'] === 'deleteUser') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new DeleteUserController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($get['action'] === 'contacts') {

            (new ViewAllContactsController())->execute();
        } elseif ($get['action'] === 'viewContact') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new viewContactController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant de message envoyé.");
            }
        } elseif ($get['action'] === 'deleteContact') {
            if (isset($get['id']) && $get['id'] > 0) {
                $id = $get['id'];

                (new DeleteContactController())->execute($id);
            } else {
                throw new Exception("Aucun identifiant d'utilisateur envoyé.");
            }
        } elseif ($get['action'] === 'adminSearch') {

            (new SearchController())->execute($post);
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new HomepageController())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require 'templates/error.php';
}
