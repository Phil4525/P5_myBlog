<?php
require_once('src/model/user.php');

function userSuppression(string $id)
{
    $userRepository = new UserRepository();
    $userRepository->connection = new DatabaseConnection();

    $success = $userRepository->deleteUser($id);

    if (!$success) {
        throw new Exception("L'utilisateur n'a pu être supprimé.");
    } else {
        header('Location: index.php?action=adminUsers');
    }
}
