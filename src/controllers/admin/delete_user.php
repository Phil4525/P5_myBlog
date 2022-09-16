<?php

namespace App\Controllers\Admin\DeleteUser;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\User\UserRepository;

class DeleteUserController
{
    public function execute(string $id)
    {
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $success = $userRepository->deleteUser($id);

        if (!$success) {
            throw new \Exception("L'utilisateur n'a pu être supprimé.");
        } else {
            header('Location: index.php?action=users');
        }
    }
}
