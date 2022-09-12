<?php

namespace App\Model\Contact;

require_once('src/lib/database.php');

use App\Lib\Database\DatabaseConnection;

class Contact
{
    public string $id;
    public string $fullname;
    public string $email;
    public string $phone;
    public string $messageContent;
    public string $frenchCreationDate;
}

class ContactRepository
{

    public DatabaseConnection $connection;

    function createContact(string $fullname, string $email, string $phone, string $messageContent): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO contacts(fullname, email, phone, message_content, message_date) VALUES(?, ?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$fullname, $email, $phone, $messageContent]);

        return ($affectedLines > 0);
    }

    function getContacts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM contacts ORDER BY message_date DESC"
        );

        $contacts = [];

        while ($row = $statement->fetch()) {
            $contact = new Contact;

            $contact->id = $row['id'];
            $contact->fullname = $row['fullname'];
            $contact->email = $row['email'];
            $contact->phone = $row['phone'];
            $contact->messageContent = $row['message_content'];
            $contact->frenchCreationDate = $row['french_creation_date'];

            $contacts[] = $contact;
        }

        return $contacts;
    }

    function getContactById(string $id): Contact
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM contacts WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $contact = new Contact;

        $contact->id = $row['id'];
        $contact->fullname = $row['fullname'];
        $contact->email = $row['email'];
        $contact->phone = $row['phone'];
        $contact->messageContent = $row['message_content'];
        $contact->frenchCreationDate = $row['french_creation_date'];

        return $contact;
    }

    function deleteContact(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM contacts WHERE id = ?');
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }
}