<?php

namespace App\Controllers;

use App\lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\UserRepository;

class PasswordRecoveryController
{
    public function execute($input)
    {
        if (isset($input['email']) && !empty($input['email'])) {
            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("L'email n'est pas valide.");
            }

            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();
            $user = $userRepository->getUserByEmail($input['email']);

            if (!$user) {
                throw new \Exception("Il n'y a pas d'utilisateur avec cette adresse mail.");
            }

            $email = md5($user->email);
            $password = md5($user->password);

            $link = "<a href='localhost/p5_myblog/index.php?action=resetPassword&key=" . $email . "&reset=" . $password . "'>Click To Reset password</a>";
            $mailContent = 'cliquez sur ce lien pour reinitialiser votre mot de pass : ' . $link . '';

            $to = $user->email;
            $subject = 'password recovery';
            $mailContent = wordwrap($mailContent, 70, "\r\n");
            $headers = [
                'From' => 'admin@myblog.com',
                'Content-Type' => 'text/html; charset=utf-8',
            ];

            $success = mail($to, $subject, $mailContent, $headers);

            if (!$success) {
                throw new \Exception("L'email n'a pu être envoyé.");
            }
            //} else {
            $globals = new Globals();
            header('Location: ' . $globals->getSERVER('HTTP_REFERER'));
            exit;
            //}
            // } else {
            //     throw new \Exception("Il n'y a pas d'utilisateur avec cette adresse mail.");
            // }
        }
    }
}
