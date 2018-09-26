<?php

namespace App\Http\Packages\Maintenance;

class ColumnParser
{

	/**
	 * Create instance of the given class and use the 
	 * available funciton setColumnValue
	 * 
	 * @return
	 */
	public static function parse($args, $columnValue)
	{
		$columnParser = new ColumnParser;
		return $columnParser->setColumnValue($args, $columnValue);
	}

    /**
     * set the value of a column based on the arguments provided 
     *
     * @param object $args list of arguments for a given column
     * @param string $columnValue value the column should have
     * @return void
     */
    protected function setColumnValue($args, $columnValue)
    {

        // check if the model sets default value for the column
        // if set, apply the value
        if(isset($args->defaultValue) && $args->defaultValue) {
            $columnValue = $args->defaultValue;
        }

        // check if the model allows hashing of the column
        // if allowed, hash the column value
        if(isset($args->isHashed) && $args->isHashed) {
            $columnValue = Hash::make("$columnValue");
        } 

        return $columnValue;
    }
}