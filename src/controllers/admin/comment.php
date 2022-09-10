<?php
require_once('src/model/comment.php');

function adminGetComments()
{
    $comments = getComments();

    // On détermine sur quelle page on se trouve
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    $commentsNb = count($comments);
    $perPage = 5;
    $pages = ceil($commentsNb / $perPage);
    $numberOne = ($currentPage * $perPage) - $perPage;

    $database = dbConnect();
    $statement = $database->prepare("SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS french_creation_date FROM comments WHERE id<= (SELECT max(id) FROM comments) ORDER BY comment_date DESC LIMIT :numberOne, :perpage;");
    $statement->bindValue(':numberOne', $numberOne, PDO::PARAM_INT);
    $statement->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

    require('templates/admin/comment.php');
}
