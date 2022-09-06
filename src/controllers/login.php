<?php

require_once('src/model.php');

function login($input)
{
    if (!empty($input)) {
        if (
            isset($input['email'], $input['password'])
            && !empty($input['email']) && !empty($input['password'])
        ) {
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'email n'est pas valide.");
            }

            $database = dbConnect();
            $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
            $statement->bindValue(":email", $input['email'], PDO::PARAM_STR);
            $statement->execute();

            $user = $statement->fetch();

            if (!$user || !password_verify($input['password'], $user['password'])) {
                throw new Exception("L'utilisateur et/ou le mot de passe est incorrect.");
            }

            @session_start();

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                // 'roles'=>$user['roles'],
            ];

            header('Location:index.php');
        }
    }
}
