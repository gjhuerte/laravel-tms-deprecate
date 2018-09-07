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
	 * Returns the list of navigation to be placed on header
	 *
	 * @return array navigation
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
					[
						'url' => 'tag',
						'name' => 'Tag',
					],
				],
			],
			[
				'url' => 'reports',
				'name' => 'Reports',
				'hasSubNavigation' => false,
			],
		];
	}
}