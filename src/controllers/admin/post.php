<?php
require_once('src/model/post.php');

function adminGetPosts()
{
    $posts = getPosts();

    // On détermine sur quelle page on se trouve
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    $postsNb = count($posts);
    $perPage = 5;
    $pages = ceil($postsNb / $perPage);
    $numberOne = ($currentPage * $perPage) - $perPage;

    $database = dbConnect();
    $statement = $database->prepare("SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM posts WHERE id<= (SELECT max(id) FROM posts) ORDER BY creation_date DESC LIMIT :numberOne, :perpage;");
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    require('templates/admin/post.php');
}
