<?php
/**
 * Activity added trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Activity added trigger class
 */
class Added extends ActivityTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/activity/added',
				'name' => __('Activity added', 'notification-buddypress'),
			]
		);

		$this->addAction('bp_activity_add', 10, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param array<string, mixed> $activityData Activity data.
	 * @param int   $activityId The id of the activity item being added.
	 * @return mixed
	 */
	public function context($activityData, $activityId)
	{
		if ($activityData['type'] !== 'activity_update') {
			return false;
		}

		$activityUser = is_numeric($activityData['user_id'])
			? get_user_by('id', (int)$activityData['user_id'])
			: null;

		if (!$activityUser instanceof \WP_User) {
			return false;
		}

		$this->activity = new \BP_Activity_Activity($activityId);
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
					'slug' => 'activity_added_datetime',
					'name' => __('Activity added date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
