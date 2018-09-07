<?php

namespace App\Http\Packages\Object;

use App\Http\Interfaces\Object;

class ObjectParser implements Object
{
	/**
	 * Creates an object from a given variable
	 * 
	 * @param  array $variable variable to be parsed
	 * @return object          object
	 */
	public static function make($variable)
	{
		$obj = json_decode (json_encode ($variable), FALSE);

		return $obj;
	}
}