<?php
require_once('src/model/user.php');

function adminGetUsers()
{
    $users = getUsers();

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    $usersNb = count($users);
    $perPage = 5;
    $pages = ceil($usersNb / $perPage);
    $numberOne = ($currentPage * $perPage) - $perPage;

    $database = dbConnect();
    // $statement = $database->prepare("SELECT * FROM users WHERE id<= (SELECT max(id) FROM users) LIMIT :numberOne, :perpage;");
    $statement = $database->prepare("SELECT * FROM users LIMIT :numberOne, :perpage;");
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    require('templates/admin/user.php');
}
