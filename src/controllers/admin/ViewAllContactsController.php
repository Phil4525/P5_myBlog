<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Globals;
use App\Repository\ContactRepository;

class ViewAllContactsController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $contactRepository = new ContactRepository();
        $contactRepository->connection = new DatabaseConnection();

        $contacts  = $contactRepository->getContacts();

        if (isset($get['page']) && !empty($get['page'])) {
            $currentPage = (int) strip_tags($get['page']);
        } else {
            $currentPage = 1;
        }

        $contactsNb = count($contacts);
        $perPage = 10;
        $pages = ceil($contactsNb / $perPage);
        $offset = ($currentPage * $perPage) - $perPage;

        $contacts = array_slice($contacts, $offset, $perPage);

        require 'templates/admin/contact.php';
    }
}
