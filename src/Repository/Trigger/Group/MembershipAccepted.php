<?php
/**
 * Membership accepted trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Membership accepted trigger class
 */
class MembershipAccepted extends GroupTrigger
{
	/**
	 * Accepted user instance.
	 *
	 * @var  \WP_User
	 */
	public $acceptedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/membership_accepted',
				'name' => __('Membership accepted', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_membership_accepted', 100, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int  $userId  ID of the user who accepted membership.
	 * @param int  $groupId ID of the group that was accepted membership to.
	 * @return mixed
	 */
	public function context($userId, $groupId)
	{
		$acceptedUser = get_user_by('id', $userId);

		if (!$acceptedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->acceptedUserObject = $acceptedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Accepted user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'accepted_user_ID',
					'name' => __('Accepted user ID', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'accepted_user_login',
					'name' => __('Accepted user login', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'accepted_user_email',
					'name' => __('Accepted user email', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'accepted_user_display_name',
					'name' => __('Accepted user display name', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'accepted_user_first_name',
					'name' => __('Accepted user first name', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'accepted_user_last_name',
					'name' => __('Accepted user last name', 'notification-buddypress'),
					'property_name' => 'acceptedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'membership_acceptance_datetime',
					'name' => __('Membership acceptance date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
