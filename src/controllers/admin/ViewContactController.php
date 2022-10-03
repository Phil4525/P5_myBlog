<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\ContactRepository;

class viewContactController
{
    public function execute(string $id)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $contactRepository = new ContactRepository();
        $contactRepository->connection = new DatabaseConnection();
        $contact = $contactRepository->getContactById($id);

        require 'templates/admin/view_contact.php';
    }
}
