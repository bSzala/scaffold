<?php namespace Fenix440\Scaffold\Helpers;

/**
 * Class TextHelper
 *
 * Utility for formatting text
 *
 * @package Fenix440\Scaffold\Helpers
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class TextHelper
{

    /**
     * Replace all occurrences of the search string with the replacement string
     *
     * @param string $search Search text
     * @param string $replace Replace text
     * @param string $text Full text
     * @return string Formatted text
     */
    public static function replace($search,$replace,$text)
    {
        return str_replace($search,$replace,$text);
    }

    /**
     * Returns a string with the first character of str capitalized, if that character is alphabetic.
     *
     * @param string $text Text to capitalize
     * @return string
     */
    public static function capitalize($text)
    {
        return ucfirst($text);
    }

}

 