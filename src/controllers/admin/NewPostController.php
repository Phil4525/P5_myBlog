<?php

namespace App\Controllers\Admin;

use App\Globals\Globals;

class NewPostController
{
    public function execute()
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        require 'templates/admin/new_post.php';
    }
}
