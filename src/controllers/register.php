<?php
require_once('src/lib/database.php');
require_once('src/model/user.php');

function register(array $input)
{
    if (!empty($input)) {
        if (
            isset($input['username'], $input['email'], $input['password'])
            && !empty($input['username']) && !empty($input['email']) && !empty($input['password'])
        ) {
            // check if username is already token
            $username = strip_tags($input['username']);

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();

            if ($userRepository->getUserByName($username)) {
                throw new Exception("Le nom d'utilisateur est déja utilisé.");
            }

            // check if email is valid
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'adresse email est incorrecte.");
            } else {
                $email = $input['email'];
            }

            $password = password_hash($input['password'], PASSWORD_ARGON2ID);

            // create new user
            $success = $userRepository->createUser($username, $email, $password);

            if (!$success) {
                throw new Exception("Impossible de créer le compte !");
            } else {
                $statement = $userRepository->connection->getConnection()->query(
                    'SELECT id FROM users ORDER BY id DESC LIMIT 1'
                );
                $id = $statement->fetch();

                session_start();

                $_SESSION['user'] = [
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                ];

                header('Location:index.php');
            }
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }
    }
}
