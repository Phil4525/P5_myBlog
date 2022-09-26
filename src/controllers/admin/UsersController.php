<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;

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

            require 'templates/admin/user.php';
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
