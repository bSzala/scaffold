<?php namespace Fenix440\Scaffold\Helpers;

/**
 * Class PathHelper
 *
 * Utility for obtaining package paths
 *
 * @package Fenix440\Scaffold\Helpers
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class PathHelper
{

    /**
     * Get base package path
     *
     * @return string
     */
    public static function getBasePath()
    {
        return realpath(__DIR__.'/../../');
    }

    /**
     * Get templates path
     *
     * @return string
     */
    public static function getTemplatesPath()
    {
        return self::getBasePath().'/templates';
    }
}

 