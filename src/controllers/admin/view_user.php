<?php

namespace App\Controllers\Admin\ViewUser;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\User\UserRepository;

class ViewUserController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            $user = $userRepository->getUserById($id);

            require('templates/admin/view_user.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
