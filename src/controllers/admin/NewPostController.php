<?php

namespace App\Controllers\Admin;

class NewPostController
{
    public function execute()
    {
        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        require 'templates/admin/new_post.php';
    }
}
