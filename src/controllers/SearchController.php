<?php

namespace App\Controllers\Search;

use App\Lib\Database\DatabaseConnection;
use App\Repository\Post\PostRepository;
use App\Model\Post\Post;

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

        $allResults = $postRepository->searchPosts($keyword);

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }

        $resultsNb = count($allResults);
        $perPage = 4;
        $pages = ceil($resultsNb / $perPage);
        $numberOne = ($currentPage * $perPage) - $perPage;

        $statement = $postRepository->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, author, 
                    DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date,
                    DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%i') AS french_modification_date  
                    FROM posts 
                    WHERE id< (SELECT max(id) FROM posts) 
                    AND title LIKE :keyword OR chapo LIKE :keyword OR content LIKE :keyword OR author LIKE :keyword
                    ORDER BY creation_date DESC LIMIT :numberOne, :perpage;"
        );
        $statement->bindValue(':keyword', '%' . $keyword . '%', \PDO::PARAM_STR);
        $statement->bindValue(':numberOne', $numberOne, \PDO::PARAM_INT);
        $statement->bindValue(':perpage', $perPage, \PDO::PARAM_INT);
        $statement->execute();

        $results = [];

        while ($row = $statement->fetch()) {
            $post = new Post();

            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->chapo = strip_tags($row['chapo']);
            $post->content = $row['content'];
            $post->author = $row['author'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->frenchModificationDate = $row['french_modification_date'];

            $results[] = $post;
        }

        require('templates/search_results.php');
    }
}
