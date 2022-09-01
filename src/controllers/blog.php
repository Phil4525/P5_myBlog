<?php

require_once('src/model.php');

// function blog()
// {
//     $allPosts = getPosts();
//     $featuredPost = array_shift($allPosts);
//     $posts = getPostsPaginated($allPosts);

//     require('templates/blog.php');
// }

function blog()
{
    $allPosts = getPosts();

    $featuredPost = array_shift($allPosts);

    // On détermine sur quelle page on se trouve
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    $postsNb = count($allPosts);
    $perPage = 4;
    $pages = ceil($postsNb / $perPage);
    $numberOne = ($currentPage * $perPage) - $perPage;

    $database = dbConnect();
    $statement = $database->prepare("SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id< (SELECT max(id) FROM posts) ORDER BY creation_date DESC LIMIT :numberOne, :perpage;");
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    require('templates/blog.php');
}
