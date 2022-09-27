<?php

namespace App\Controllers;

use App\Globals\Globals;

class LogoutController
{
    public function execute()
    {
        $globals = new Globals();
        $globals->unsetSESSION('user');

        header('Location: index.php');
        exit;
    }
}
