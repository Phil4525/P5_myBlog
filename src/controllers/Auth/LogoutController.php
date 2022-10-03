<?php

namespace App\Controllers\Auth;

use App\Lib\Redirect;
use App\Lib\Globals;

class LogoutController
{
    public function execute()
    {
        $globals = new Globals();
        $globals->unsetSESSION('user');

        $redirect = new Redirect('index.php');
        $redirect->execute();
    }
}
