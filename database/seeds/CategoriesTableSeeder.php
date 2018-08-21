<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
	protected $table = 'categories';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
        DB::table($this->table)->insert([
        	['name' => 'Network and Internet', ],
        	['name' => 'Users Administration', ],
        	['name' => 'IT Support', ],
        	['name' => 'General Questions', ],
        	['name' => 'Security', ],
        ]);
    }
}
