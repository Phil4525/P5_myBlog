<?php

namespace App\Controllers\Admin\DeleteContact;

require_once('src/lib/database.php');
require_once('src/model/contact.php');

use App\Lib\Database\DatabaseConnection;
use App\Model\Contact\ContactRepository;

class DeleteContactController
{
    public function execute(string $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();
            $success = $contactRepository->deleteContact($id);

            if (!$success) {
                throw new \Exception("Le message n'a pu être supprimé.");
            } else {
                header('Location: index.php?action=contacts');
            }
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
