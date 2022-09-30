<?php

namespace App\Lib;

class Redirect
{
    private $location;

    public function __construct(string $loc)
    {
        $this->location = $loc;
    }

    public function execute()
    {
        header('Location: ' . $this->location);
        exit;
    }
}
