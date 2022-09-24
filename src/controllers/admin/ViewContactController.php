<?php

namespace App\Controllers\Admin\ViewContact;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/contact.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Contact\ContactRepository;

class viewContactController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();
            $contact = $contactRepository->getContactById($id);

            require('templates/admin/view_contact.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
