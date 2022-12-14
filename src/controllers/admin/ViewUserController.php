<?php

namespace App\Controllers\Admin;

use App\Lib\DatabaseConnection;
use App\Lib\Redirect;
use App\Lib\Globals;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;

class ViewUserController
{
    public function execute(string $id, ?array $input)
    {
        $globals = new Globals();
        $session = $globals->getSESSION('user');

        if (!isset($session) || $session['role'] != 'admin') {
            throw new \Exception("Vous n'avez pas l'autorisation d'accéder à cette page.");
        }

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        if ($input !== null) {
            if (isset($input['role']) && !empty($input['role'])) {

                $role = $input['role'];

                $success = $userRepository->updateUserRole($id, $role);

                if (!$success) {
                    throw new \Exception("Le role de l'utilisateur n'a pu être sauvegarder");
                }

                $redirect = new Redirect(('index.php?action=users'));
                $redirect->execute();
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
        }

        $user = $userRepository->getUserById($id);

        if ($user == null) {
            throw new \Exception("L'utilisateur' $id n'existe pas.");
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $userComments = $commentRepository->getCommentsByUsername($user->username);

        $userCommentsNb = count($userComments);

        $lastUserComment = null;
        if ($userComments) $lastUserComment = array_shift($userComments);


        require 'templates/admin/view_user.php';
    }
}
