<?php

namespace App\Controllers\Auth;

use App\Lib\DatabaseConnection;
use App\Repository\UserRepository;

class ResetPasswordController
{
    public function execute(string $email, string $password, ?array $input)
    {
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $user = $userRepository->getUserByHashedPasswordAndEmail($email, $password);

        if ($user) {
            if ($input !== null) {
                if (isset($input['new_password']) && !empty(trim($input['new_password']))) {

                    $newPassword = password_hash($input['new_password'], PASSWORD_ARGON2ID);
                    $success = $userRepository->updatePassword($user->email, $newPassword);

                    if (!$success) {
                        throw new \Exception("Le mot de passe n'a pu être modifié.");
                    } else {
                        echo ("<script>window.close();</script>");
                    }
                } else {
                    throw new \Exception("Les données du formulaire sont invalides.");
                }
            }
        } else {
            throw new \Exception("Il n'y a pas d'utilisateur avec ces identifiants");
        }

        require 'templates/reset_password.php';
    }
}
