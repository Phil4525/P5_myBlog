<?php

require_once('src/model.php');

function createUser(string $username, string $email, string $password)
{
    $database = dbConnect();

    $statement = $database->prepare(
        'INSERT INTO users(username, email, `password`) VALUES(?, ?, ?)'
    );

    $affectedLines = $statement->execute([$username, $email, $password]);

    return ($affectedLines > 0);
}

function getUserByName(string $username)
{
    $database = dbConnect();

    $statement = $database->prepare("SELECT * FROM users WHERE username=?");
    $statement->execute([$username]);
    $user = $statement->fetch();

    return $user;
}
