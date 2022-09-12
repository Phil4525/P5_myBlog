<?php
require_once('src/model/contact.php');

function contactSuppression(string $id)
{
    $contactRepository = new ContactRepository();
    $contactRepository->connection = new DatabaseConnection();
    $success = $contactRepository->deleteContact($id);

    if (!$success) {
        throw new Exception("Le message n'a pu être supprimé.");
    } else {
        header('Location: index.php?action=adminContacts');
    }
}
