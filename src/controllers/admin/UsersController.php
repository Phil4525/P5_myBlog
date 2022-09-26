<?php

namespace App\Controllers\Admin\Users;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\User\UserRepository;
use App\Repository\Comment\CommentRepository;

class UsersController
{
    public function execute()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            $users = $userRepository->getUsers();

            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = (int) strip_tags($_GET['page']);
            } else {
                $currentPage = 1;
            }

            $usersNb = count($users);
            $perPage = 10;
            $pages = ceil($usersNb / $perPage);
            $offset = ($currentPage * $perPage) - $perPage;

            $users = array_slice($users, $offset, $perPage);

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $comments = $commentRepository->getComments();

            foreach ($users as $user) {
                $commentsNb = 0;
                foreach ($comments as $comment) {
                    if ($user->username == $comment->author) {
                        $commentsNb++;
                    }
                }
                $usersWithCommentsNb[] = [$user, $commentsNb];
            }

            require('templates/admin/user.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
