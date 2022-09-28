<?php

namespace App\Lib;

class HtmlCleaner
{
    public function clean(string $input): string
    {
        $output = htmlspecialchars(strip_tags($input));
        return $output;
    }
}
