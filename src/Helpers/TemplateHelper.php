<?php namespace BSzala\Scaffold\Helpers;

/**
 * Class TemplateHelper
 *
 * Utility for formatting templates
 *
 * @package BSzala\Scaffold\Helpers
 * @author      Bartlomiej Szala <fenix440@gmail.com>
 */
class TemplateHelper
{

    /**
     * Format template name
     *
     * @param string $name Template name
     * @return string Formatted template name
     */
    public static function prettyName($name)
    {
        return TextHelper::capitalize(TextHelper::replace("_"," ",$name));
    }


}

 