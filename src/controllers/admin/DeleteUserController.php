<?php

namespace App\Controllers\Admin\DeleteUser;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\User\UserRepository;

class DeleteUserController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            $success = $userRepository->deleteUser($id);

            if (!$success) {
                throw new \Exception("L'utilisateur n'a pu être supprimé.");
            } else {
                header('Location: index.php?action=users');
                die;
            }
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
