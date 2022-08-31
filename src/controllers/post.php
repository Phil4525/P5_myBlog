<?php

require_once('src/model.php');
require_once('src/model/comment.php');

function post(string $id)
{
    $post = getPost($id);
    $comments = getComments($id);

    // $comments = [
    //     [
    //         'author' => 'Un premier faux auteur',
    //         'french_creation_date' => '03/03/2022 à 12h15min42s',
    //         'comment' => 'Un faux commentaire.\n Le premier.',
    //     ],
    //     [
    //         'author' => 'Un second faux auteur',
    //         'french_creation_date' => '03/03/2022 à 12h16min42s',
    //         'comment' => 'Un faux commentaire.\n Le second.',
    //     ],
    // ];

    require('templates/post.php');

    print_r($comments);
}
