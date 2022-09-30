<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Globals\Globals;
use App\Repository\UserRepository;

class DeleteUserController
{
    public function execute(string $id)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $success = $userRepository->deleteUser($id);

        if (!$success) {
            throw new \Exception("L'utilisateur n'a pu être supprimé.");
        } else {
            // header('Location: index.php?action=users');
            // exit;
            $redirect = new Redirect('index.php?action=users');
            $redirect->execute();
        }
        // } else {
        //     throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        // }
    }
}
