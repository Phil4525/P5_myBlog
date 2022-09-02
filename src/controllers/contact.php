<?php
require_once('src/models/contact.php');

function contact($input)
{
    if (!empty($input)) {
        if (
            isset($input['fullname'], $input['email'], $input['message_content'])
            && !empty($input['fullname']) && !empty($input['email']) && !empty($input['message_content'])
        ) {
            $fullname = strip_tags($input['fullname']);
            $email = strip_tags($input['email']);
            $phone = strip_tags($input['phone']);
            $messageContent = nl2br(htmlspecialchars($input['message_content']));
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }

        $success = createContact($fullname, $email, $phone, $messageContent);
        if (!$success) {
            throw new Exception("Impossible d'envoyer le message !");
        } else {
            header('Location: index.php#contact-form');

            $to = 'admin@myblog.com';
            $subject = 'nouveau message de ' . $fullname;
            $mailContent = wordwrap($messageContent, 70, "\r\n");
            $headers = [
                'From' => $email,
                'Reply-To' => 'admin@myblog.com',
                'Content-Type' => 'text/html; charset=utf-8',
            ];

            mail($to, $subject, $mailContent, $headers);
        }
    }
}
