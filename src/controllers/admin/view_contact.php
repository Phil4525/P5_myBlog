<?php
require_once('src/model/contact.php');

function viewContact(string $id)
{
    $contact = getContactById($id);

    require('templates/admin/view_contact.php');
}
