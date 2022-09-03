<?php

require_once('src/model.php');
// require_once('src/models/user.php');

function register($input)
{
    if (!empty($input)) {
        if (
            isset($input['username'], $input['email'], $input['password'])
            && !empty($input['username']) && !empty($input['email']) && !empty($input['password'])
        ) {
            $username = strip_tags($input['username']);

            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'adresse email est incorrecte.");
            } else {
                $email = $input['email'];
            }
            $password = password_hash($input['password'], PASSWORD_ARGON2ID);

            // $success = createUser($username, $email, $password);

            $database = dbConnect();
            $statement = $database->prepare(
                'INSERT INTO users(username, email, `password`) VALUES(?, ?, ?)'
            );
            $success = $statement->execute([$username, $email, $password]);

            if (!$success) {
                throw new Exception("Impossible de créer le compte !");
            } else {
                $id = $database->lastInsertId('users'); // not working with createUser(), need same database connexion

                session_start();

                $_SESSION['user'] = [
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    // 'roles'=>$user['roles'],
                ];

                // var_dump($_SESSION);

                header('Location:index.php');
            }
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }
    }


    require('templates/register.php');
}
