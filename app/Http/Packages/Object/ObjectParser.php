<?php

namespace App\Http\Packages\Object;

use App\Http\Interfaces\Object;

class ObjectParser implements Object
{
	/**
	 * Creates an object from a given variable
	 * @param  [type] $variable input variable
	 * @return [type]           object
	 */
	public static function make($variable)
	{
		$obj = json_decode (json_encode ($variable), FALSE);
		return $obj;
	}
}