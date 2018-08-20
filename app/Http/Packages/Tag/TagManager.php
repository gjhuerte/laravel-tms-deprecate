<?php

namespace App\Http\Packages\Tag;

class TagManager
{

    /**
     * Sanitize passed string and returns it in array format
     * 
     * @param string $string comma separated string
     * @param constant $filter filter to be used. default string
     *
     * @return list of all tags
     */
    public static function sanitize($string, $filter = FILTER_SANITIZE_STRING)
    {
        $tags = [];
        $string = TagManager::split($string);

        foreach($string as $tag) {
            $tags[] = filter_var($tag, $filter);
        }

        return $tags;
    }

    /**
     * Pass a string and returns array splitted by delimiter
     * 
     * @param $string accepts string separated by delimiter
     * 
     * @return array $string split by using explode
     */
    public static function split($string, $delimiter = ',')
    {
        $string = explode($delimiter, $string);
        return $string;
    }
}