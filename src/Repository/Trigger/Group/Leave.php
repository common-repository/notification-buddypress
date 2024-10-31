<?php
/**
 * Leave group trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Leave group trigger class
 */
class Leave extends GroupTrigger
{
	/**
	 * Leaving user instance.
	 *
	 * @var  \WP_User
	 */
	public $leavingUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{

		parent::__construct(
			[
				'slug' => 'buddypress/group/leave',
				'name' => __('User leaves group', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_leave_group', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $groupId ID of the group being banned from.
	 * @param int $userId  ID of the user being banned.
	 * @return mixed
	 */
	public function context($groupId, $userId)
	{
		$leavingUser = get_user_by('id', $userId);

		if (!$leavingUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->leavingUserObject = $leavingUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Leaving user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'leaving_user_ID',
					'name' => __('Leaving user ID', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'leaving_user_login',
					'name' => __('Leaving user login', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'leaving_user_email',
					'name' => __('Leaving user email', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'leaving_user_display_name',
					'name' => __('Leaving user display name', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'leaving_user_first_name',
					'name' => __('Leaving user first name', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'leaving_user_last_name',
					'name' => __('Leaving user last name', 'notification-buddypress'),
					'property_name' => 'leavingUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'leave_datetime',
					'name' => __('Leave date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
