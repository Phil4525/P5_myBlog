<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class SearchController
{
    public function execute(?array $input)
    {
        $globals = new Globals();
        $get = $globals->getGET();

        if (isset($input['keyword']) && !empty(trim($input['keyword']))) {
            $keyword = strip_tags(strtolower($input['keyword']));
        } elseif (isset($get['keyword']) && !empty(trim($get['keyword']))) {
            $keyword = strip_tags(strtolower($get['keyword']));
        } else {
            throw new \Exception("Aucun terme de recherche n'a été saisi.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $postsResults = $postRepository->searchPosts($keyword);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $commentResults = $commentRepository->searchComments($keyword);

        $results = array_merge($postsResults, $commentResults);

        usort($results, function ($a, $b) {
            return strtotime($b->frenchCreationDate) - strtotime($a->frenchCreationDate);
        });

        if (isset($get['page']) && !empty($get['page'])) {
            $currentPage = (int) strip_tags($get['page']);
        } else {
            $currentPage = 1;
        }

        $resultsNb = count($results);
        $perPage = 5;
        $pages = ceil($resultsNb / $perPage);
        $offset = ($currentPage * $perPage) - $perPage;

        $results = array_slice($results, $offset, $perPage);

        $session = $globals->getSESSION('user');

        if (isset($session) && $session['role'] == 'admin' && $get['action'] == 'adminSearch') {
            require 'templates/admin/search_results.php';
            return;
        }
        // } else {
        require 'templates/search_results.php';
        // }
    }
}
