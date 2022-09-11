<?php
require_once('src/lib/database.php');
require_once('src/model/user.php');

function adminGetUsers()
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
        "SELECT * FROM users LIMIT :numberOne, :perpage;"
    );
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();

    $users = [];
    while ($row = $statement->fetch()) {
        $user = new User;

        $user->id = $row['id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->password = $row['password'];

        $users[] = $user;
    }

    require('templates/admin/user.php');
}
