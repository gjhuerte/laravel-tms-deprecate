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
            self::$home,
            self::$ticketing,
            self::$maintenance,
            self::$reports,
        ]);
    }

    /**
     * Returns list of navigation used in maintenance
     *
     * @return object maintenance list
     */
    protected function getMaintenanceOnly()
    {
        return ObjectParser::make(self::$maintenance);
    }

    /**
     * Homepage navigation routes
     *
     * @var array
     */
    private static $home = [
        'url' => '/',
        'name' => 'Home',
        'hasSubNavigation' => false,
    ];

    /**
     * Ticketing navigation routes
     *
     * @var array
     */
    private static $ticketing = [
        'url' => 'ticket',
        'name' => 'Ticket',
        'hasSubNavigation' => false,
    ];

    /**
     * Maintenance navigation routes
     *
     * @var array
     */
    private static $maintenance = [
        'url' => '#',
        'name' => 'Maintenance',
        'hasSubNavigation' => true,
        'subNavigation' =>  [
            'category' => [
                'url' => 'category',
                'name' => 'Category',
            ],
            'organization' => [
                'url' => 'organization',
                'name' => 'Organization',
            ],
            'level' => [
                'url' => 'level',
                'name' => 'Level',
            ],
        ],
    ];

    /**
     * Reports navigation routes
     *
     * @var array
     */
    private static $reports = [
        'url' => 'reports',
        'name' => 'Reports',
        'hasSubNavigation' => false,
    ];
}
