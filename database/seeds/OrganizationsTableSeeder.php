<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
	protected $table = 'organizations';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table ($this->table )->truncate();
        DB::table( $this->table )->insert([
        	[
        		'name' => 'System Administrators',
        		'abbreviation' => 'SA',
        	]
        ]);
    }
}
