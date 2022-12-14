<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Lib\Globals;
use App\Repository\UserRepository;

class AdminLoginController
{
    public function execute(?array $input)
    {
        if (!empty($input)) {
            if (
                isset($input['email'], $input['password'])
                && !empty($input['email']) && !empty($input['password'])
            ) {
                if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("L'email n'est pas valide.");
                }

                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();
                $user = $userRepository->getUserByEmail($input['email']);

                if (!$user || !password_verify($input['password'], $user->password)) {
                    throw new \Exception("L'utilisateur ou le mot de passe est incorrect.");
                }

                if ($user->role !== 'admin') {
                    throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
                }

                $userData = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                ];

                $globals = new Globals();
                $globals->setSESSION('user', $userData);

                $redirect = new Redirect('index.php?action=dashboard');
                $redirect->execute();
            }
        }
    }
}
