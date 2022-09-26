<?php

namespace App\Controllers;

use App\Lib\DatabaseConnection;
use App\Repository\PostRepository;

class SearchController
{
    public function execute(array $input)
    {
        if (isset($input['keyword']) && !empty($input['keyword'])) {
            $keyword = trim(strip_tags(strtolower($input['keyword'])));
        } elseif (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = trim(strip_tags(strtolower($_GET['keyword'])));
        } else {
            throw new \Exception("Aucun terme de recherche n'a été saisi.");
        }

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $results = $postRepository->searchPosts($keyword);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $resultsNb = count($results);
        $perPage = 5;
        $pages = ceil($resultsNb / $perPage);
        $offset = ($currentPage * $perPage) - $perPage;

        $results = array_slice($results, $offset, $perPage);

        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
            require 'templates/admin/search_results.php';
        } else {
            require 'templates/search_results.php';
        }
    }
}
