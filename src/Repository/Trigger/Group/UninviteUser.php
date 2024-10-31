<?php
/**
 * Uninvite user to group trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Uninvite user to group trigger class
 */
class UninviteUser extends GroupTrigger
{
	/**
	 * Uninvited user instance.
	 *
	 * @var  \WP_User
	 */
	public $uninvitedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/uninvite_user',
				'name' => __('Uninvite user to group', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_uninvite_user', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $groupId ID of the group being uninvited to.
	 * @param int $userId  ID of the user being uninvited.
	 * @return mixed
	 */
	public function context($groupId, $userId)
	{
		$uninvitedUser = get_user_by('id', $userId);

		if (!$uninvitedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->uninvitedUserObject = $uninvitedUser;
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
					'slug' => 'uninvited_user_ID',
					'name' => __('Uninvited user ID', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'uninvited_user_login',
					'name' => __('Uninvited user login', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'uninvited_user_email',
					'name' => __('Uninvited user email', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'uninvited_user_display_name',
					'name' => __('Uninvited user display name', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'uninvited_user_first_name',
					'name' => __('Uninvited user first name', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'uninvited_user_last_name',
					'name' => __('Uninvited user last name', 'notification-buddypress'),
					'property_name' => 'uninvitedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'uninvite_datetime',
					'name' => __('Uninvite date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
