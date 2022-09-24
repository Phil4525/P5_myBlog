<?php

namespace App\Controllers\Logout;

class LogoutController
{
    public function execute()
    {
        session_start();

        unset($_SESSION['user']);

        header('Location: index.php');
    }
}
