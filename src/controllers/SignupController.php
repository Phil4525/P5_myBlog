<?php

namespace App\Controllers\Signup;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/user.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\User\UserRepository;

class SignupController
{
    public function execute(array $input)
    {
        if (!empty($input)) {
            if (
                isset($input['username'], $input['email'], $input['password'])
                && !empty(trim($input['username'])) && !empty($input['email']) && !empty(trim($input['password']))
            ) {
                $username = strip_tags($input['username']);

                // check if username is already token
                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();

                if ($userRepository->getUserByName($username)) {
                    throw new \Exception("Le nom d'utilisateur est déja utilisé.");
                }

                // check if email is valid
                if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("L'adresse email est incorrecte.");
                } else {
                    $email = $input['email'];
                }

                // handle password
                $password = password_hash($input['password'], PASSWORD_ARGON2ID);

                // create new user
                $success = $userRepository->createUser($username, $email, $password);

                if (!$success) {
                    throw new \Exception("Impossible de créer le compte !");
                } else {
                    // get last created user id
                    $statement = $userRepository->connection->getConnection()->query(
                        'SELECT id FROM users ORDER BY id DESC LIMIT 1'
                    );
                    $id = $statement->fetch();

                    $_SESSION['user'] = [
                        'id' => $id,
                        'username' => $username,
                        'email' => $email,
                        'role' => 'user',
                    ];

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
        }
    }
}
