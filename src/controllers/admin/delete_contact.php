<?php
require_once('src/models/contact.php');

function contactSuppression(string $id)
{
    deleteContact($id);

    header('Location: index.php?action=adminContacts');
}
