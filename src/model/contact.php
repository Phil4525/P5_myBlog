<?php

namespace App\Model;

// class Contact
// {
//     public string $id;
//     public string $fullname;
//     public string $email;
//     public string $phone;
//     public string $messageContent;
//     public string $frenchCreationDate;
// }

class Contact
{
    public string $id;
    public string $fullname;
    public string $email;
    public string $phone;
    public string $messageContent;
    public string $frenchCreationDate;

    public function __construct(
        string $id,
        string $fullname,
        string $email,
        string $phone,
        string $messageContent,
        string $frenchCreationDate
    ) {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->messageContent = $messageContent;
        $this->frenchCreationDate = $frenchCreationDate;
    }
}
