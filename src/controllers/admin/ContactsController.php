<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\ContactRepository;

class ContactsController
{
    public function execute()
    {
        $globals = new Globals();
        $get = $globals->getGET();
        $session = $globals->getSESSION('user');

        if (isset($session) && $session['role'] == 'admin') {

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();

            $contacts  = $contactRepository->getContacts();

            if (isset($get['page']) && !empty($get['page'])) {
                $currentPage = (int) strip_tags($get['page']);
            } else {
                $currentPage = 1;
            }

            $contactsNb = count($contacts);
            $perPage = 5;
            $pages = ceil($contactsNb / $perPage);
            $offset = ($currentPage * $perPage) - $perPage;

            $contacts = array_slice($contacts, $offset, $perPage);

            require 'templates/admin/contact.php';
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
