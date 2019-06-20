<?php

namespace App\Http\Packages\Navigation;

use App\Http\Packages\Object\ObjectParser;

class Navigation
{

    /**
     * Returns all the navigation listed
     *
     * @return object navigation
     */
    public static function all()
    {
        return (new Navigation)->get();
    }
    
    /**
     * Returns the list of navigation to be placed on header
     *
     * @return object navigation
     */
    protected function get()
    {
        return ObjectParser::make([
            'home' => [
                'url' => url('/'),
                'name' => 'Home',
                'hasSubNavigation' => false,
            ],
            'ticket' => [
                'url' => '',
                'name' => 'Ticket',
                'hasSubNavigation' => false,
            ],
            'maintenance' => [
                'url' => '#',
                'name' => 'Maintenance',
                'hasSubNavigation' => true,
                'subNavigation' =>  [
                    'category' => [
                        'url' => route('category.index'),
                        'name' => 'Category',
                    ],
                    'organization' => [
                        'url' => route('organization.index'),
                        'name' => 'Organization',
                    ],
                    'level' => [
                        'url' => route('level.index'),
                        'name' => 'Level',
                    ],
                    'ticket_tags' => [
                        'url' => route('ticket.tag.index'),
                        'name' => 'Ticket Tag',
                    ],
                    'user' => [
                        'url' => route('user.index'),
                        'name' => 'User',
                    ],
                ]
            ],
            'reports' => [
                'url' => 'reports',
                'name' => 'Reports',
                'hasSubNavigation' => false,
            ],
        ]);
    }
}
