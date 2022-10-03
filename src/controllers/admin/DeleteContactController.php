<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Globals\Globals;
use App\Repository\ContactRepository;

class DeleteContactController
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
        $success = $contactRepository->deleteContact($id);

        if (!$success) {
            throw new \Exception("Le message n'a pu être supprimé.");
        }
        // } else {
        // header('Location: index.php?action=contacts');
        // exit;
        $redirect = new Redirect('index.php?action=contacts');
        $redirect->execute();
        // }
        // } else {
        //     throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        // }
    }
}
