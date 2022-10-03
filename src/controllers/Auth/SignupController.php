<?php

namespace App\Controllers\Auth;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Lib\Globals;
use App\Repository\UserRepository;

class SignupController
{
    public function execute(array $input)
    {
        if (!empty($input)) {
            if (
                isset($input['username'], $input['email'], $input['password'])
                && !empty(trim($input['username'])) && !empty($input['email']) && !empty(trim($input['password']))
            ) {
                $username = htmlspecialchars(strip_tags($input['username']));

                // check if username is already token
                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();

                if ($userRepository->getUserByName($username)) {
                    throw new \Exception("Le nom d'utilisateur est déja utilisé.");
                }

                // check if email is valid
                if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("L'adresse email n'est pas correcte.");
                } else {
                    $email = $input['email'];
                }

                // handle password
                $password = password_hash($input['password'], PASSWORD_ARGON2ID);

                // create new user
                $success = $userRepository->createUser($username, $email, $password);

                if (!$success) {
                    throw new \Exception("Impossible de créer le compte !");
                }

                // get last created user id
                $statement = $userRepository->connection->getConnection()->query(
                    'SELECT id FROM users ORDER BY id DESC LIMIT 1'
                );
                $id = $statement->fetch();

                $userData = [
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    'role' => 'user',
                ];

                $globals = new Globals();
                $globals->setSESSION('user', $userData);

                $redirect = new Redirect($globals->getSERVER('HTTP_REFERER'));
                $redirect->execute();
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
        }
    }
}
