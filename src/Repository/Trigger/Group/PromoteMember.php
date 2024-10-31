<?php
/**
 * Promote group member trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Promote group member trigger class
 */
class PromoteMember extends GroupTrigger
{
	/**
	 * Promoted user instance.
	 *
	 * @var  \WP_User
	 */
	public $promotedUserObject;

	/**
	 * Promotion status.
	 *
	 * @var  string
	 */
	public $promotionStatus;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/group/promote_member',
				'name' => __('Promote group member', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_promote_member', 1000, 3);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int    $groupId  ID of the group being promoted in.
	 * @param int    $userId   ID of the user being promoted.
	 * @param string $status   New status being promoted to.
	 * @return mixed
	 */
	public function context($groupId, $userId, $status)
	{
		$promotedUser = get_user_by('id', $userId);

		if (!$promotedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->promotedUserObject = $promotedUser;

		switch ($status) {
			case 'mod':
				$this->promotionStatus = __('Moderator', 'notification-buddypress');
				break;

			case 'admin':
				$this->promotionStatus = __('Administrator', 'notification-buddypress');
				break;

			default:
				$this->promotionStatus = __('Undefined', 'notification-buddypress');
				break;
		}
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Promoted user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'promoted_user_ID',
					'name' => __('Promoted user ID', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'promoted_user_login',
					'name' => __('Promoted user login', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'promoted_user_email',
					'name' => __('Promoted user email', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'promoted_user_display_name',
					'name' => __('Promoted user display name', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'promoted_user_first_name',
					'name' => __('Promoted user first name', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'promoted_user_last_name',
					'name' => __('Promoted user last name', 'notification-buddypress'),
					'property_name' => 'promotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'promoted_user_status',
					'name' => __('Promoted user status in group', 'notification-buddypress'),
					'description' => __('Either Moderator or Administrator', 'notification-buddypress'),
					'group' => __('User', 'notification-buddypress'),
					'resolver' => static function (PromoteMember $trigger) {
						return $trigger->promotionStatus;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'promotion_datetime',
					'name' => __('Promotion date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
