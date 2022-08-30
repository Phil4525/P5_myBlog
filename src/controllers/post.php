<?php

require_once('src/model.php');

function post(string $id)
{
    $post = getPost($id);

    require('templates/post.php');
}



// function post()
// {
//     $post = [
//         'title' => 'Un faux titre.',
//         'french_creation_date' => '03/03/2022 à 12h14min42s',
//         'content' => "Le faux contenu de mon billet.\nC'est fantastique !",
//     ];
//     require('templates/post.php');
// }
