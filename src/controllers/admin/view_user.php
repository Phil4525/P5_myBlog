<?php
require_once('src/model/user.php');

function viewUser(string $id)
{
    $userRepository = new UserRepository();
    $userRepository->connection = new DatabaseConnection();

    $user = $userRepository->getUserById($id);

    require('templates/admin/view_user.php');
}
