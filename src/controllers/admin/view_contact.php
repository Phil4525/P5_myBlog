<?php
require_once('src/model/contact.php');

function viewContact(string $id)
{
    $contactRepository = new ContactRepository();
    $contactRepository->connection = new DatabaseConnection();
    $contact = $contactRepository->getContactById($id);

    require('templates/admin/view_contact.php');
}
