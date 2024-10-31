<?php
/**
 * Activity deleted trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Activity deleted trigger class
 */
class Deleted extends ActivityTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/activity/deleted',
				'name' => __('Activity deleted', 'notification-buddypress'),
			]
		);

		$this->addAction('bp_activity_delete', 10);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array<string, mixed> $activityData Array of deleted activity.
	 * @return mixed
	 */
	public function context($activityData)
	{
		if ($activityData['type'] !== 'activity_update') {
			return false;
		}

		$activity = is_numeric($activityData['id'])
			? new \BP_Activity_Activity((int)$activityData['id'])
			: null;
		$activityUser = is_numeric($activityData['user_id'])
			? get_user_by('id', (int)$activityData['user_id'])
			: null;

		if (!$activity instanceof \BP_Activity_Activity || !$activityUser instanceof \WP_User) {
			return false;
		}

		$this->activity = $activity;
		$this->activityUserObject = $activityUser;
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
					'slug' => 'activty_deletion_datetime',
					'name' => __('Activity deletion date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
