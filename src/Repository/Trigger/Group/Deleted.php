<?php
/**
 * Group created trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Group created trigger class
 */
class Deleted extends GroupTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{

		parent::__construct(
			[
				'slug' => 'buddypress/group/deleted',
				'name' => __('Group deleted', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_before_delete_group', 10);
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
					'slug' => 'deletion_datetime',
					'name' => __('Deletion date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
