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
            $user = $userRepository->getUserByName($username);

            if ($user) {
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
            // $database = dbConnect();
            // $userRepository->connection = new DatabaseConnection();

            // $statement = $userRepository->connection->getConnection->prepare(
            //     'INSERT INTO users(username, email, `password`) VALUES(?, ?, ?)'
            // );
            $success = $userRepository->createUser($username, $email, $password);

            if (!$success) {
                throw new Exception("Impossible de créer le compte !");
            } else {
                // $id = $userRepository->connection->getConnection->lastInsertId('users'); // not working with createUser(), need same database connexion
                $statement = $userRepository->connection->getConnection()->query(
                    'SELECT MAX(id) FROM users'
                );
                $row = $statement->fetch();
                $id = $row['id'];

                session_start();

                $_SESSION['user'] = [
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    // 'roles'=>$user['roles'],
                ];

                header('Location:index.php');
            }
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }
    }
}
