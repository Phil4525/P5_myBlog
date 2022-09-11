<?php
require_once('src/lib/database.php');

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
}

function createContact(string $fullname, string $email, string $phone, string $messageContent)
{
    $database = dbConnect();
    $statement = $database->prepare(
        'INSERT INTO contacts(fullname, email, phone, message_content, message_date) VALUES(?, ?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$fullname, $email, $phone, $messageContent]);

    return ($affectedLines > 0);
}

function getContacts()
{
    $database = dbConnect();

    $statement = $database->query("SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM contacts ORDER BY message_date DESC");

    $contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $contacts;
}

function getContactById(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare("SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM contacts WHERE id = ?");
    $statement->execute([$id]);

    $contact = $statement->fetch(PDO::FETCH_ASSOC);

    return $contact;
}

function deleteContact(string $id)
{
    $database = dbConnect();

    $statement = $database->prepare('DELETE FROM contacts WHERE id = ?');
    $affectedLines = $statement->execute([$id]);

    return ($affectedLines > 0);
}
