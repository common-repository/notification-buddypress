<?php
/**
 * Group details updated trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Group details updated trigger class
 */
class DetailsUpdated extends GroupTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/details_updated',
				'name' => __('Group details updated', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_details_updated', 10, 3);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int    $groupId Group ID.
	 * @param object $group    Old Group object.
	 * @param bool   $notify   If notify users.
	 * @return mixed
	 */
	public function context($groupId, $group, $notify)
	{
		if (! $notify) {
			return false;
		}

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
					'slug' => 'details_update_datetime',
					'name' => __('Details update date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
