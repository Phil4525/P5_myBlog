<?php

function dbConnect()
{
    $database = new PDO('mysql:host=localhost;dbname=P5_myBlog;charset=utf8', 'root', '');

    return $database;
}
