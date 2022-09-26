<?php

namespace App\Controllers;

class LogoutController
{
    public function execute()
    {
        unset($_SESSION['user']);

        header('Location: index.php');
        exit;
    }
}
