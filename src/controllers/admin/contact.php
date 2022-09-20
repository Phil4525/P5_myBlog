<?php

namespace App\Controllers\Admin\Contacts;

require_once('src/lib/database.php');
require_once('src/model/contact.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Contact\ContactRepository;
use App\Model\Contact\Contact;

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
            $numberOne = ($currentPage * $perPage) - $perPage;

            $statement = $contactRepository->connection->getConnection()->prepare(
                "SELECT id, fullname, email, phone, message_content, DATE_FORMAT(contact_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM contacts WHERE id<= (SELECT max(id) FROM contacts) ORDER BY contact_date DESC LIMIT :numberOne, :perpage;"
            );
            $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
            $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
            $statement->execute();

            $contacts = [];

            while ($row = $statement->fetch()) {
                $contact = new Contact;

                $contact->id = $row['id'];
                $contact->fullname = $row['fullname'];
                $contact->email = $row['email'];
                $contact->phone = $row['phone'];
                $contact->messageContent = $row['message_content'];
                $contact->frenchCreationDate = $row['french_creation_date'];

                $contacts[] = $contact;
            }

            require('templates/admin/contact.php');
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
