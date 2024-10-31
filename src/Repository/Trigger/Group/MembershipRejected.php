<?php
/**
 * Membership rejected trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Membership rejected trigger class
 */
class MembershipRejected extends GroupTrigger
{
	/**
	 * Rejected user instance.
	 *
	 * @var  \WP_User
	 */
	public $rejectedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/membership_rejected',
				'name' => __('Membership rejected', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_membership_rejected', 100, 3);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int  $userId  ID of the user who rejected membership.
	 * @param int  $groupId ID of the group that was rejected membership to.
	 * @return mixed
	 */
	public function context($userId, $groupId)
	{
		$rejectedUser = get_user_by('id', $userId);

		if (!$rejectedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->rejectedUserObject = $rejectedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Rejected user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'rejected_user_ID',
					'name' => __('Rejected user ID', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'rejected_user_login',
					'name' => __('Rejected user login', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'rejected_user_email',
					'name' => __('Rejected user email', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'rejected_user_display_name',
					'name' => __('Rejected user display name', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'rejected_user_first_name',
					'name' => __('Rejected user first name', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'rejected_user_last_name',
					'name' => __('Rejected user last name', 'notification-buddypress'),
					'property_name' => 'rejectedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'membership_rejection_datetime',
					'name' => __('Membership rejection date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
