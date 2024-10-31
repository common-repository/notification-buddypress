<?php
/**
 * Remove from favorites trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Activity as ActivityTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Remove from favorites trigger class
 */
class RemoveFromFavorities extends ActivityTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/activity/favorities/remove',
				'name' => __('Activity removed from favorites', 'notification-buddypress'),
			]
		);

		$this->addAction('bp_activity_remove_user_favorite', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $activityId ID of the activity item being favorited.
	 * @param int $userId     ID of the user doing the favoriting.
	 * @return mixed
	 */
	public function context($activityId, $userId)
	{
		$activity = new \BP_Activity_Activity($activityId);
		$favoringUser = get_user_by('id', $userId);
		// phpcs:ignore Squiz.NamingConventions.ValidVariableName.MemberNotCamelCaps
		$activityUser = get_user_by('id', $activity->user_id);

		if (!$favoringUser instanceof \WP_User || !$activityUser instanceof \WP_User) {
			return false;
		}

		$this->activity = $activity;
		$this->favoringUserObject = $favoringUser;
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

		$this->favoringUserMergeTags();

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'activity_removal_from_favorities_datetime',
					'name' => __('Activity removal from favorities date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
