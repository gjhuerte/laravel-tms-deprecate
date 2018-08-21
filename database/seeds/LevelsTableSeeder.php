<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
	protected $table = 'levels';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
        DB::table($this->table)->insert([
        	['name' => 'Level 1', ],
        	['name' => 'Level 2', ],
        	['name' => 'Level 3', ],
        	['name' => 'Level 4', ],
        	['name' => 'Level 5', ],
        ]);
    }
}
