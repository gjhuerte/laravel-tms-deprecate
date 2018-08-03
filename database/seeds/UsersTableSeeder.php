<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	protected $table = 'users';
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
        		'username' => 'admin',
        		'password' => Hash::make('123456789'),
        		'firstname' => 'John',
        		'lastname' => 'Doe',
        		'email' => 'johndoe@email.com',
        	],
        ]);
    }
}
