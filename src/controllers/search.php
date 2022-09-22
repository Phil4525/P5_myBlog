<?php

namespace App\Controllers\Search;

use App\Lib\Database\DatabaseConnection;
use App\Model\Post\PostRepository;

class SearchController
{
    // public function execute(string $keyword)
    public function execute(array $input)
    {
        $keyword = trim(strip_tags(strtolower($input['keyword'])));

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $results = $postRepository->searchPosts($keyword);

        // header('Location: index.php?action=searchResults');
        require('templates/search_results.php');
    }
}
