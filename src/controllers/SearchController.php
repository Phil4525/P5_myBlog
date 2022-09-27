<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Globals\Globals;
use App\Repository\PostRepository;

class SearchController
{
    public function execute(array $input)
    {
        $globals = new Globals();
        $get = $globals->getGET();

        if (isset($input['keyword']) && !empty($input['keyword'])) {
            $keyword = trim(strip_tags(strtolower($input['keyword'])));
        } elseif (isset($get['keyword']) && !empty($get['keyword'])) {
            $keyword = trim(strip_tags(strtolower($get['keyword'])));
        } else {
            throw new \Exception("Aucun terme de recherche n'a été saisi.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $results = $postRepository->searchPosts($keyword);

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

        if (isset($session) && $session['role'] == 'admin') {
            require 'templates/admin/search_results.php';
        } else {
            require 'templates/search_results.php';
        }
    }
}
