<?php

namespace App\Controllers\Admin\ViewContact;

require_once('src/lib/database.php');
require_once('src/model/contact.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Contact\ContactRepository;

class viewContactController
{
    public function execute(string $id)
    {
        $contactRepository = new ContactRepository();
        $contactRepository->connection = new DatabaseConnection();
        $contact = $contactRepository->getContactById($id);

        require('templates/admin/view_contact.php');
    }
}

// function viewContact(string $id)
// {
//     $contactRepository = new ContactRepository();
//     $contactRepository->connection = new DatabaseConnection();
//     $contact = $contactRepository->getContactById($id);

//     require('templates/admin/view_contact.php');
// }
