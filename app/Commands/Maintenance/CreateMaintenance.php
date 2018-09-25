<?php

namespace App\Commands\Maintenance;

use Illuminate\Http\Route;
use App\Http\Packages\Maintenance\ColumnParser;

class CreateMaintenance
{
	protected $request;
	protected $class;
	protected $variable;

	/**
	 * Constructor
	 */
	public function __construct($request, $class, $variable)
	{
		$this->request = $request;
		$this->class = $class;
		$this->variable = $variable;
	}

	/**
	 * [handle description]
	 * @return [type] [description]
	 */
	public function handle()
	{

		// loops through each columns specified under the class model
		// each column has a key and value pair that can be used in designing
		// the data to be stored in a table
        foreach($this->class->columns as $key => $args) {

        	// use the object functionality and parse the given argument into the object
            // and checks if the argument is enabled for saving by setting the save variable into 
            $args = ObjectParser::make($args);
            if($args->save) {
                $this->class->$key = ColumnParser::parse($args, $this->variable->fields->$key);
            }
        }

        $this->class->save();
	}
}