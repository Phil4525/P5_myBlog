<?php
require_once('src/models/user.php');

function viewUser(string $id)
{
    $user = getUserById($id);

    require('templates/admin/view_user.php');
}
