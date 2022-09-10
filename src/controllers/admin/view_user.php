<?php
require_once('src/model/user.php');

function viewUser(string $id)
{
    $user = getUserById($id);

    require('templates/admin/view_user.php');
}
