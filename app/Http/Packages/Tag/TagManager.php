<?php

namespace App\Http\Packages\Tag;

class TagManager
{

    /**
     * Sanitize passed string and returns it in array format
     * 
     * @param string $string separated by certain delimiter
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
     * @param string $string accepts string separated by delimiter
     * @param string $delimiter delimiter for string to be separated. default comma
     * 
     * @return array $string split by using explode
     */
    public static function split($string, $delimiter = ',')
    {
        $arrayList = explode($delimiter, $string);
        return $arrayList;
    }

    /**
     * Pass an array and returns a single string separated by delimiter
     * 
     * @param array $array accepts array list of items
     * @param string $delimiter delimiter for string to be separated. default comma
     * 
     * @return string $string split by using explode
     */
    public static function merge($array, $delimiter = ',')
    {
        $string = implode($delimiter, $array);
        return $string;
    }
}