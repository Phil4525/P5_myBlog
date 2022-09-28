<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\UserRepository;

class LoginController
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

                $userData = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                ];

                $globals = new Globals();
                $globals->setSESSION('user', $userData);

                // $_SESSION['user'] = [
                //     'id' => $user->id,
                //     'username' => $user->username,
                //     'email' => $user->email,
                //     'role' => $user->role,
                // ];

                // header('Location: ' . $_SERVER['HTTP_REFERER']);
                header('Location: ' . $globals->getSERVER('HTTP_REFERER'));
                exit;
            }
        }
    }
}
