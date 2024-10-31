<?php
/**
 * Unban group member trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Unban group member trigger class
 */
class UnbanMember extends GroupTrigger
{
	/**
	 * Unbanned user instance.
	 *
	 * @var  \WP_User
	 */
	public $unbannedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/unban_member',
				'name' => __('Unban group member', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_unban_member', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $groupId ID of the group being unbanned from.
	 * @param int $userId  ID of the user being unbanned.
	 * @return mixed
	 */
	public function context($groupId, $userId)
	{
		$unbannedUser = get_user_by('id', $userId);

		if (!$unbannedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->unbannedUserObject = $unbannedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Banned user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'unbanned_user_ID',
					'name' => __('Unbanned user ID', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'unbanned_user_login',
					'name' => __('Unbanned user login', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'unbanned_user_email',
					'name' => __('Unbanned user email', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'unbanned_user_display_name',
					'name' => __('Unbanned user display name', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'unbanned_user_first_name',
					'name' => __('Unbanned user first name', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'unbanned_user_last_name',
					'name' => __('Unbanned user last name', 'notification-buddypress'),
					'property_name' => 'unbannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'unban_datetime',
					'name' => __('Unban date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
