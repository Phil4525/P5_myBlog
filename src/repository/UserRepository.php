<?php

namespace App\Repository;

use App\Lib\DatabaseConnection;
use App\Model\User;

class UserRepository
{
    public DatabaseConnection $connection;

    public function getUserByEmail(string $email): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date 
            FROM users 
            WHERE email = ?"
        );
        $statement->execute([$email]);
        $row = $statement->fetch();

        $user = null;

        if ($row) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['role'],
                $row['french_creation_date']
            );
        }

        return $user;
    }

    public function createUser(string $username, string $email, string $password): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users(username, email, password, signup_date) VALUES(?, ?, ?, NOW())'
        );

        $affectedLines = $statement->execute([$username, $email, $password]);

        return ($affectedLines > 0);
    }

    public function getUserByName(string $username): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date 
            FROM users 
            WHERE username=?"
        );
        $statement->execute([$username]);
        $row = $statement->fetch();

        $user = null;

        if ($row) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['role'],
                $row['french_creation_date']
            );
        }

        return $user;
    }

    public function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date 
            FROM users 
            ORDER BY signup_date DESC"
        );

        $users = [];

        while ($row = $statement->fetch()) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['role'],
                $row['french_creation_date']
            );

            $users[] = $user;
        }

        return $users;
    }

    public function getUserById(string $id): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date 
            FROM users WHERE id=?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $user = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['password'],
            $row['role'],
            $row['french_creation_date']
        );

        return $user;
    }

    public function deleteUser(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM users WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }

    public function getMostActiveUser(): array
    {
        $statement = $this->connection->getConnection()->query(
            'SELECT users.id, COUNT(comments.id) AS comments_number, users.username 
            FROM users 
            INNER JOIN comments ON comments.author = users.username 
            GROUP BY users.id 
            ORDER BY comments_number DESC LIMIT 0,1'
        );
        $row = $statement->fetch();

        $mostActiveUser = [
            'id' => $row['id'],
            'username' => $row['username'],
            'comments_number' => $row['comments_number']
        ];

        return $mostActiveUser;
    }

    public function updateUserRole(string $id, string $role): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET role = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$role, $id]);

        return ($affectedLines > 0);
    }

    public function getUserByHashedPasswordAndEmail(string $emailHash, string $passwordHash): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, password, role, DATE_FORMAT(signup_date, '%d/%m/%Y à %Hh%i') AS french_creation_date
            FROM users 
            WHERE md5(email)= ? and md5(password)= ?"
        );
        $statement->execute([$emailHash, $passwordHash]);
        $row = $statement->fetch();

        $user = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['password'],
            $row['role'],
            $row['french_creation_date']
        );

        return $user;
    }

    public function updatePassword(string $email, string $newPassword): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE users SET password= ? where email= ?'
        );
        $affectedLines = $statement->execute([$newPassword, $email]);

        return ($affectedLines > 0);
    }
}
