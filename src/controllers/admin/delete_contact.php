<?php
require_once('src/model/contact.php');

function contactSuppression(string $id)
{
    deleteContact($id);

    header('Location: index.php?action=adminContacts');
}
