<?php

use Illuminate\Database\Seeder;

class SystemFunctionsTableSeeder extends Seeder
{
	protected $table = 'system_functions';
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
                'name' => 'Close Ticket',
                'key' => 'close_ticket_id',
            ],
            [ 
                'name' => 'Create Ticket',
                'key' => 'create_ticket_id',
            ],
            [ 
                'name' => 'Update Ticket',
                'key' => 'update_ticket_id',
            ],
            [ 
                'name' => 'Remove Ticket',
                'key' => 'remove_ticket_id',
            ],
            [ 
                'name' => 'Reopen Ticket',
                'key' => 'reopen_ticket_id',
            ],
            [ 
                'name' => 'Resolve Ticket',
                'key' => 'resolve_ticket_id',
            ],
            [ 
                'name' => 'Ticket Assigning',
                'key' => 'assign_to_user_ticket_id',
            ],
            [ 
                'name' => 'Create User',
                'key' => 'create_users_information',
            ],
            [ 
                'name' => 'Remove User',
                'key' => 'remove_users_information',
            ],
            [ 
                'name' => 'Update User',
                'key' => 'update_users_information',
            ],
        ]);
    }
}
