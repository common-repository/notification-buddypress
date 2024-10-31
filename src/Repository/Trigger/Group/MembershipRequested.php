<?php
/**
 * Membership requested trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Membership requested trigger class
 */
class MembershipRequested extends GroupTrigger
{
	/**
	 * Requesting user instance.
	 *
	 * @var  \WP_User
	 */
	public $requestingUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/membership_requested',
				'name' => __('Membership requested', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_membership_requested', 100, 3);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int          $userId  ID of the user requesting membership.
	 * @param array<mixed> $admins  Array of group admins.
	 * @param int          $groupId ID of the group being requested to.
	 * @return mixed
	 */
	public function context($userId, $admins, $groupId)
	{
		$requestingUser = get_user_by('id', $userId);

		if (!$requestingUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->requestingUserObject = $requestingUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		$this->addMergeTag(
			new MergeTag\UrlTag(
				[
					'slug' => 'group_requests_url',
					'name' => __('Group requests link', 'notification-buddypress'),
					'description' => __('Leads to group membership requests page', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'resolver' => static function (MembershipRequested $trigger) {
						$url = bp_get_group_permalink($trigger->buddyGroup) . 'admin/membership-requests';

						return esc_url($url);
					},
				]
			)
		);

		// Requesting user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'requesting_user_ID',
					'name' => __('Requesting user ID', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'requesting_user_login',
					'name' => __('Requesting user login', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'requesting_user_email',
					'name' => __('Requesting user email', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'requesting_user_display_name',
					'name' => __('Requesting user display name', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'requesting_user_first_name',
					'name' => __('Requesting user first name', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'requesting_user_last_name',
					'name' => __('Requesting user last name', 'notification-buddypress'),
					'property_name' => 'requestingdUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'membership_request_datetime',
					'name' => __('Membership request date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
