<?php

namespace App\Http\Interfaces;

interface Tag
{
    public static function sanitize($string, $filter);
    public static function split($string, $delimiter);
}