<?php

use App\Models\User\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::truncate();
		
        User::create([
			'username' => 'admin',
			'password' => Hash::make('123456789'),
			'firstname' => 'John',
			'lastname' => 'Doe',
			'email' => 'johndoe@email.com',
			'organization_id' => 1,
			'role' => 'Head Administrator',
		]);
		
        User::create([
			'username' => 'user-1',
			'password' => Hash::make('123456789'),
			'firstname' => 'Peter',
			'lastname' => 'Penduko',
			'email' => 'pp@email.com',
			'organization_id' => 2,
			'role' => 'Site Manager',
        ]);
		
        User::create([
			'username' => 'assignator-1',
			'password' => Hash::make('123456789'),
			'firstname' => 'Juan',
			'lastname' => 'Dela Cruz',
			'email' => 'jdcpp@email.com',
			'organization_id' => 3,
			'role' => 'Desk Support',
        ]);
		
        User::create([
			'username' => 'tech-support-1',
			'password' => Hash::make('123456789'),
			'firstname' => 'Justin',
			'lastname' => 'Timberlake',
			'email' => 'tj@email.com',
			'organization_id' => 4,
			'role' => 'Technical Support',
        ]);
    }
}
