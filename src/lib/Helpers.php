<?php

namespace App\Lib;

class Helpers
{
    public static function esc_html($text)
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }

    public static function wp_check_invalid_utf8($string, $strip = false)
    {
        $string = (string) $string;

        if (0 === strlen($string)) {
            return '';
        }

        // Check for support for utf8 in the installed PCRE library once and store the result in a static.
        static $utf8_pcre = null;
        if (!isset($utf8_pcre)) {
            // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
            $utf8_pcre = @preg_match('/^./u', 'a');
        }
        // We can't demand utf8 in the PCRE installation, so just return the string in those cases.
        if (!$utf8_pcre) {
            return $string;
        }

        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- preg_match fails when it encounters invalid UTF8 in $string.
        if (1 === @preg_match('/^./us', $string)) {
            return $string;
        }

        // Attempt to strip the bad chars if requested (not recommended).
        if ($strip && function_exists('iconv')) {
            return iconv('utf-8', 'utf-8', $string);
        }

        return '';
    }

    public static function _wp_specialchars($string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false)
    {
        $string = (string) $string;

        if (0 === strlen($string)) {
            return '';
        }

        // Don't bother if there are no specialchars - saves some processing.
        if (!preg_match('/[&<>"\']/', $string)) {
            return $string;
        }

        // Account for the previous behaviour of the function when the $quote_style is not an accepted value.
        if (empty($quote_style)) {
            $quote_style = ENT_NOQUOTES;
        } elseif (ENT_XML1 === $quote_style) {
            $quote_style = ENT_QUOTES | ENT_XML1;
        } elseif (!in_array($quote_style, array(ENT_NOQUOTES, ENT_COMPAT, ENT_QUOTES, 'single', 'double'), true)) {
            $quote_style = ENT_QUOTES;
        }


        $charset = 'UTF-8';

        $_quote_style = $quote_style;

        if ('double' === $quote_style) {
            $quote_style  = ENT_COMPAT;
            $_quote_style = ENT_COMPAT;
        } elseif ('single' === $quote_style) {
            $quote_style = ENT_NOQUOTES;
        }

        $string = htmlspecialchars($string, $quote_style, $charset, $double_encode);

        // Back-compat.
        if ('single' === $_quote_style) {
            $string = str_replace("'", '&#039;', $string);
        }

        return $string;
    }
}
