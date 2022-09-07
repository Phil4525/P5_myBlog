<?php
require_once('src/models/contact.php');

function adminGetContacts()
{
    $contacts  = getContacts();

    // On détermine sur quelle page on se trouve
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    $contactsNb = count($contacts);
    $perPage = 5;
    $pages = ceil($contactsNb / $perPage);
    $numberOne = ($currentPage * $perPage) - $perPage;

    $database = dbConnect();
    $statement = $database->prepare("SELECT id, fullname, email, phone, message_content, DATE_FORMAT(message_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM contacts WHERE id<= (SELECT max(id) FROM contacts) ORDER BY message_date DESC LIMIT :numberOne, :perpage;");
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();
    $contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

    require('templates/admin/contact.php');
}
