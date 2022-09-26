<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Repository\ContactRepository;

class viewContactController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();
            $contact = $contactRepository->getContactById($id);

            require 'templates/admin/view_contact.php';
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
