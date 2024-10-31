<?php
/**
 * Ban group member trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Ban group member trigger class
 */
class BanMember extends GroupTrigger
{
	/**
	 * Banned user instance.
	 *
	 * @var  \WP_User
	 */
	public $bannedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/ban_member',
				'name' => __('Ban group member', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_ban_member', 100, 2);
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
		$bannedUser = get_user_by('id', $userId);

		if (!$bannedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->bannedUserObject = $bannedUser;
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
					'slug' => 'banned_user_ID',
					'name' => __('Banned user ID', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'banned_user_login',
					'name' => __('Banned user login', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'banned_user_email',
					'name' => __('Banned user email', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'banned_user_display_name',
					'name' => __('Banned user display name', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'banned_user_first_name',
					'name' => __('Banned user first name', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'banned_user_last_name',
					'name' => __('Banned user last name', 'notification-buddypress'),
					'property_name' => 'bannedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'ban_datetime',
					'name' => __('Ban date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
