<?php

namespace App\Controllers\Admin\AdminLogin;

use App\Lib\Database\DatabaseConnection;
use App\Repository\User\UserRepository;

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

                $_SESSION['user'] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                ];

                header('Location:index.php?action=dashboard');
            }
        }
    }
}
