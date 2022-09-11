<?php
require_once('src/lib/database.php');

class User
{
    public string $id;
    public string $username;
    public string $email;
    public string $password;
}

class UserRepository
{
    public DatabaseConnection $connection;

    function getUserByEmail(string $email): User
    {
        // $statement = $this->connection->getConnection()->prepare(
        //     'SELECT * FROM users WHERE email = :email'
        // );
        $statement = $this->connection->getConnection()->prepare(
            'SELECT * FROM users WHERE email = ?'
        );
        // $statement->bindValue(":email", $email, PDO::PARAM_STR);
        $statement->execute([$email]);
        $row = $statement->fetch();

        if (!$row) {
            throw new Exception("L'utilisateur et/ou le mot de passe est incorrect.");
        } else {
            $user = new User();

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];

            return $user;
        }
    }

    function createUser(string $username, string $email, string $password): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users(username, email, `password`) VALUES(?, ?, ?)'
        );

        $affectedLines = $statement->execute([$username, $email, $password]);

        return ($affectedLines > 0);
    }

    function getUserByName(string $username): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE username=?"
        );
        $statement->execute([$username]);
        $row = $statement->fetch();

        if ($row) {
            $user = new User();

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
        }

        return $user;
    }

    function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query("SELECT * FROM users");

        $users = [];

        while ($row = $statement->fetch()) {
            $user = new User;

            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];

            $users[] = $user;
        }

        return $users;
    }

    function getUserById(string $id): User
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$id]);
        $row = $statement->fetch();

        $user = new User;

        $user->id = $row['id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->password = $row['password'];

        return $user;
    }

    function deleteUser(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM users WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }
}
