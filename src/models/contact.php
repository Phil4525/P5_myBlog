<?php
require_once('src/model.php');

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

    $statement = $database->query("SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM contacts ORDER BY message_date DESC");

    $contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $contacts;
}
