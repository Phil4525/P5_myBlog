<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Repository\ContactRepository;

class SendContactController
{
    public function execute(array $input)
    {
        if (!empty($input)) {

            if (
                isset($input['fullname'], $input['email'], $input['message_content'])
                && !empty(trim($input['fullname'])) && !empty(trim($input['email'])) && !empty(trim($input['message_content']))
            ) {
                $fullname = strip_tags($input['fullname']);

                if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("L'adresse email est incorrecte.");
                }

                $email = $input['email'];

                $phone = strip_tags($input['phone']);

                $messageContent = nl2br(htmlspecialchars($input['message_content']));
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $contactRepository = new ContactRepository();
            $contactRepository->connection = new DatabaseConnection();
            $success = $contactRepository->createContact($fullname, $email, $phone, $messageContent);

            if (!$success) {
                throw new \Exception("Impossible d'envoyer le message !");
            }

            $to = 'admin@myblog.com';
            $subject = 'nouveau message de ' . $fullname;
            $mailContent = wordwrap($messageContent, 70, "\r\n");
            $headers = [
                'From' => $email,
                'Reply-To' => 'admin@myblog.com',
                'Content-Type' => 'text/html; charset=utf-8',
            ];

            mail($to, $subject, $mailContent, $headers);

            $redirect = new Redirect('index.php#contact-form');
            $redirect->execute();
        }
    }
}
