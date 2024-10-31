<?php
/**
 * Group settings updated trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Group settings updated trigger class
 */
class SettingsUpdated extends GroupTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/settings_updated',
				'name' => __('Group settings updated', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_settings_updated', 10);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $groupId Newly created group ID.
	 * @return mixed
	 */
	public function context($groupId)
	{
		$this->buddyGroup = groups_get_group($groupId);
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'settings_update_datetime',
					'name' => __('Settings update date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
