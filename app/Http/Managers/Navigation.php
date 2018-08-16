<?php

namespace App\Http\Managers;

use App\Http\Packages\Object\ObjectParser;

class Navigation
{
	/**
	 * [all description]
	 * @return [type] [description]
	 */
	public static function all()
	{
		$navigation = new Navigation;
        $navigationList = ObjectParser::make($navigation->getList());
        return $navigationList;
	}

	/**
	 * [getList description]
	 * @return [type] [description]
	 */
	public function getList()
	{
		return [
			[
				'url' => '/',
				'name' => 'Home',
				'hasSubNavigation' => false,
			],
			[
				'url' => 'ticket',
				'name' => 'Ticket',
				'hasSubNavigation' => false,
			],
			[
				'url' => '#',
				'name' => 'Maintenance',
				'hasSubNavigation' => true,
				'subNavigation' =>  [
					[
						'url' => 'user',
						'name' => 'User',
					],
					[
						'url' => 'category',
						'name' => 'Category',
					],
					[
						'url' => 'organization',
						'name' => 'Organization',
					],
					[
						'url' => 'level',
						'name' => 'Level',
					],
				],
			],
			[
				'url' => 'reports',
				'name' => 'Reports',
				'hasSubNavigation' => false,
			],
			[
				'url' => 'settings',
				'name' => 'Settings',
				'hasSubNavigation' => false,
			],
		];
	}
}