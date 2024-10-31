<?php
/**
 * Invite user to group trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Invite user to group trigger class
 */
class InviteUser extends GroupTrigger
{
	/**
	 * Invited user instance.
	 *
	 * @var  \WP_User
	 */
	public $invitedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{

		parent::__construct(
			[
				'slug' => 'buddypress/group/invite_user',
				'name' => __('Invite user to group', 'notification-buddypress'),
			]
		);

		$this->addAction('notification_buddypress_group_invite', 10, 2);
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
		$invitedUser = get_user_by('id', $userId);

		if (!$invitedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->invitedUserObject = $invitedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Invited user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'invited_user_ID',
					'name' => __('Invited user ID', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'invited_user_login',
					'name' => __('Invited user login', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'invited_user_email',
					'name' => __('Invited user email', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'invited_user_display_name',
					'name' => __('Invited user display name', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'invited_user_first_name',
					'name' => __('Invited user first name', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'invited_user_last_name',
					'name' => __('Invited user last name', 'notification-buddypress'),
					'property_name' => 'invitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'invitation_datetime',
					'name' => __('Invitation date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
