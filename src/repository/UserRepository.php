<?php

namespace App\Repository\User;

use App\Lib\Database\DatabaseConnection;
use App\Model\User\User;

class UserRepository
{
    public DatabaseConnection $connection;

    function getUserByEmail(string $email): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM users WHERE email = ?"
        );
        $statement->execute([$email]);
        $row = $statement->fetch();

        $user = null;

        if ($row) {
            $user = new User();

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->frenchCreationDate = $row['french_creation_date'];
        }

        return $user;
    }

    function createUser(string $username, string $email, string $password): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users(username, email, password, signup_date) VALUES(?, ?, ?, NOW())'
        );

        $affectedLines = $statement->execute([$username, $email, $password]);

        return ($affectedLines > 0);
    }

    function getUserByName(string $username): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM users WHERE username=?"
        );
        $statement->execute([$username]);
        $row = $statement->fetch();

        $user = null;

        if ($row) {
            $user = new User();

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->frenchCreationDate = $row['french_creation_date'];
        }

        return $user;
    }

    function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM users ORDER BY signup_date DESC"
        );

        $users = [];

        while ($row = $statement->fetch()) {
            $user = new User;

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->frenchCreationDate = $row['french_creation_date'];

            $users[] = $user;
        }

        return $users;
    }

    function getUserById(string $id): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM users WHERE id=?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $user = new User;

        $user->id = $row['id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->role = $row['role'];
        $user->frenchCreationDate = $row['french_creation_date'];

        return $user;
    }

    function deleteUser(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM users WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }

    function getMostActiveUser(): User
    {
        $statement = $this->connection->getConnection()->query(
            'SELECT users.id, COUNT(comments.id) AS number, users.username 
            FROM users 
            INNER JOIN comments ON comments.author = users.username 
            GROUP BY users.id 
            ORDER BY number DESC LIMIT 0,1'
        );
        $row = $statement->fetch();

        $mostActiveUser = new User;

        $mostActiveUser->id = $row['id'];
        $mostActiveUser->username = $row['username'];
        $mostActiveUser->comments_number = $row['number'];

        return $mostActiveUser;
    }

    function updateUserRole(string $id, string $role): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET role = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$role, $id]);

        return ($affectedLines > 0);
    }

    function getUserByHashedPasswordAndEmail(string $emailHash, string $passwordHash): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT email,password FROM users WHERE md5(email)= ? and md5(password)= ?"
        );
        $statement->execute([$emailHash, $passwordHash]);
        $row = $statement->fetch();

        $user = new User;

        $user->email = $row['email'];
        $user->password = $row['password'];

        return $user;
    }

    function updatePassword(string $email, string $newPassword): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET password= ? where email= ?'
        );
        $affectedLines = $statement->execute([$newPassword, $email]);

        return ($affectedLines > 0);
    }
}