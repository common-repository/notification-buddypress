<?php
/**
 * Join group trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Join group trigger class
 */
class Join extends GroupTrigger
{
	/**
	 * Joined user instance.
	 *
	 * @var  \WP_User
	 */
	public $joinedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{

		parent::__construct(
			[
				'slug' => 'buddypress/group/join',
				'name' => __('User joined to group', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_join_group', 100, 2);
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
		$joinedUser = get_user_by('id', $userId);

		if (!$joinedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->joinedUserObject = $joinedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Joining user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'joined_user_ID',
					'name' => __('Joined user ID', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'joined_user_login',
					'name' => __('Joined user login', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'joined_user_email',
					'name' => __('Joined user email', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'joined_user_display_name',
					'name' => __('Joined user display name', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'joined_user_first_name',
					'name' => __('Joined user first name', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'joined_user_last_name',
					'name' => __('Joined user last name', 'notification-buddypress'),
					'property_name' => 'joinedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'join_datetime',
					'name' => __('Join date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
