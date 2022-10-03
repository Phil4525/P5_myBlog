<?php

namespace App\Model;

class User
{
    public string $id;
    public string $username;
    public string $email;
    public string $password;
    public string $role;
    public string $frenchCreationDate;

    public function __construct(
        string $id,
        string $username,
        string $email,
        string $password,
        string $role,
        string $frenchCreationDate
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->frenchCreationDate = $frenchCreationDate;
    }
}
