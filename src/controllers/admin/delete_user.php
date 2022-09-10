<?php
require_once('src/model/user.php');

function userSuppression(string $id)
{
    deleteUser($id);

    header('Location: index.php?action=adminUsers');
}
