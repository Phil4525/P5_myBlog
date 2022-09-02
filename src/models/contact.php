<?php
require_once('src/model.php');

function createContact(string $fullname, string $email, string $phone, string $messageContent)
{
    $database = dbConnect();
    $statement = $database->prepare(
        'INSERT INTO messages(fullname, email, phone, message_content, message_date) VALUES(?, ?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$fullname, $email, $phone, $messageContent]);

    return ($affectedLines > 0);
}
