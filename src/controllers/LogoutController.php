<?php

namespace App\Controllers;

use App\Lib\Redirect;
use App\Globals\Globals;

class LogoutController
{
    public function execute()
    {
        $globals = new Globals();
        $globals->unsetSESSION('user');

        // header('Location: index.php');
        // exit;
        $redirect = new Redirect('index.php');
        $redirect->execute();
    }
}
