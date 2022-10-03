<?php

namespace App\Lib;

class Helpers
{
    public static function esc_html($text)
    {
        return htmlentities($text);
    }
}
