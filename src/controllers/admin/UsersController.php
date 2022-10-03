<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;

class UsersController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $users = $userRepository->getUsers();

        if (isset($get['page']) && !empty($get['page'])) {
            $currentPage = (int) strip_tags($get['page']);
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
    }
}
