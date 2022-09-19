<?php

namespace App\Controllers\Admin\ViewUser;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\User\UserRepository;

class ViewUserController
{
    public function execute(string $id, ?array $input)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            if ($input !== null) {
                if (isset($input['role']) && !empty($input['role'])) {

                    $role = $input['role'];

                    $success = $userRepository->updateUserRole($id, $role);

                    if (!$success) {
                        throw new \Exception("Le role de l'utilisateur n'a pu être sauvegarder");
                    } else {
                        header('Location: index.php?action=users');
                    }
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
            }

            $user = $userRepository->getUserById($id);

            if ($user == null) {
                throw new \Exception("L'utilisateur' $id n'existe pas.");
            }

            require('templates/admin/view_user.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
