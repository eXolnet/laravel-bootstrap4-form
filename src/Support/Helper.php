<?php

namespace Exolnet\LaravelBootstrap4Form\Support;

class Helper
{
    /**
     * @param string $string
     * @return string
     */
    public static function stringArrayToDotNotation(string $string)
    {
        $key = preg_replace(['/\[/', '/\]/'], '.', $string, 1);
        return str_replace(['[', ']'], '', $key);
    }
}
