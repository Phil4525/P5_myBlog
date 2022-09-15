<?php

namespace App\Controllers\Admin\Users;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\User\UserRepository;
use App\Model\User\User;
use App\Model\Comment\CommentRepository;

class UsersController
{
    public function execute()
    {
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $users = $userRepository->getUsers();

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $usersNb = count($users);
        $perPage = 5;
        $pages = ceil($usersNb / $perPage);
        $numberOne = ($currentPage * $perPage) - $perPage;

        $statement = $userRepository->connection->getConnection()->prepare(
            "SELECT id, username, email, 'password', DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM users ORDER BY signup_date DESC LIMIT :numberOne, :perpage;"
        );
        $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
        $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $statement->execute();

        $users = [];

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comments = $commentRepository->getComments();

        while ($row = $statement->fetch()) {
            $user = new User;
            $commentsNb = 0;

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->frenchCreationDate = $row['french_creation_date'];

            foreach ($comments as $comment) {
                if ($user->username == $comment->author) {
                    $commentsNb++;
                }
            }

            $users[] = [$user, $commentsNb];
        }

        require('templates/admin/user.php');
    }
}
