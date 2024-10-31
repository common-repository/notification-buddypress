<?php
/**
 * Remove group member trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Remove group member trigger class
 */
class RemoveMember extends GroupTrigger
{
	/**
	 * Removed user instance.
	 *
	 * @var  \WP_User
	 */
	public $removedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/remove_member',
				'name' => __('Remove group member', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_remove_member', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $groupId ID of the group being removed from.
	 * @param int $userId  ID of the user being removed.
	 * @return mixed
	 */
	public function context($groupId, $userId)
	{
		$removedUser = get_user_by('id', $userId);

		if (!$removedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->removedUserObject = $removedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Removed user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'removed_user_ID',
					'name' => __('Removed user ID', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'removed_user_login',
					'name' => __('Removed user login', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'removed_user_email',
					'name' => __('Removed user email', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'removed_user_display_name',
					'name' => __('Removed user display name', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'removed_user_first_name',
					'name' => __('Removed user first name', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'removed_user_last_name',
					'name' => __('Removed user last name', 'notification-buddypress'),
					'property_name' => 'removedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'removal_datetime',
					'name' => __('Member removal date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
