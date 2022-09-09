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

function getUserById(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare("SELECT * FROM users WHERE id=?");
    $statement->execute([$id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function getUserByName(string $username)
{
    $database = dbConnect();

    $statement = $database->prepare("SELECT * FROM users WHERE username=?");
    $statement->execute([$username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function getUsers()
{
    $database = dbConnect();

    $statement = $database->query("SELECT * FROM users");

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}

function deleteUser(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare('DELETE FROM users WHERE id = ?');
    $affectedLines = $statement->execute([$id]);

    return ($affectedLines > 0);
}
