<?php

namespace App\Controllers\Login;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\User\UserRepository;

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

                if (!password_verify($input['password'], $user->password)) {
                    throw new \Exception("L'utilisateur et/ou le mot de passe est incorrect.");
                }

                session_start();

                $_SESSION['user'] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                ];

                header('Location:index.php');
            }
        }
    }
}

// function login(?array $input)
// {
//     if (!empty($input)) {
//         if (
//             isset($input['email'], $input['password'])
//             && !empty($input['email']) && !empty($input['password'])
//         ) {
//             if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
//                 throw new Exception("L'email n'est pas valide.");
//             }

//             $userRepository = new UserRepository();
//             $userRepository->connection = new DatabaseConnection();
//             $user = $userRepository->getUserByEmail($input['email']);

//             if (!password_verify($input['password'], $user->password)) {
//                 throw new Exception("L'utilisateur et/ou le mot de passe est incorrect.");
//             }

//             session_start();

//             $_SESSION['user'] = [
//                 'id' => $user->id,
//                 'username' => $user->username,
//                 'email' => $user->email,
//             ];

//             header('Location:index.php');
//         }
//     }
// }
