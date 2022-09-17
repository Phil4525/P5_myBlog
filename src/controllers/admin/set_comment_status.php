<?php

namespace App\Controllers\Admin\SetCommentStatus;

class SetCommentStatusController
{
    public function execute(string $id, array $input)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        } else {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }
    }
}
