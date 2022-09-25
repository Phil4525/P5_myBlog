<?php

namespace App\Controllers\Admin\Contacts;

require_once('src/lib/DatabaseConnection.php');
require_once('src/model/contact.php');

use App\Lib\Database\DatabaseConnection;
use App\Repository\Contact\ContactRepository;

class ContactsController
{
    public function execute()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();

            $contacts  = $contactRepository->getContacts();

            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $currentPage = (int) strip_tags($_GET['page']);
            } else {
                $currentPage = 1;
            }

            $contactsNb = count($contacts);
            $perPage = 5;
            $pages = ceil($contactsNb / $perPage);
            $offset = ($currentPage * $perPage) - $perPage;

            $contacts = array_slice($contacts, $offset, $perPage);

            require('templates/admin/contact.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
