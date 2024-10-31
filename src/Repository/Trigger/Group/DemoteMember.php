<?php
/**
 * Demote group member trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Group;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Group as GroupTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Demote group member trigger class
 */
class DemoteMember extends GroupTrigger
{
	/**
	 * Demoted user instance.
	 *
	 * @var  \WP_User
	 */
	public $demotedUserObject;

	/**
	 * Constructor
	 */
	public function __construct()
	{

		parent::__construct(
			[
				'slug' => 'buddypress/group/demote_member',
				'name' => __('Demote group member', 'notification-buddypress'),
			]
		);

		$this->addAction('groups_demote_member', 10, 2);
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
		$demotedUser = get_user_by('id', $userId);

		if (!$demotedUser instanceof \WP_User) {
			return false;
		}

		$this->buddyGroup = groups_get_group($groupId);
		$this->demotedUserObject = $demotedUser;
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		parent::mergeTags();

		// Demoted user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'demoted_user_ID',
					'name' => __('Demoted user ID', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'demoted_user_login',
					'name' => __('Demoted user login', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'demoted_user_email',
					'name' => __('Demoted user email', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'demoted_user_display_name',
					'name' => __('Demoted user display name', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'demoted_user_first_name',
					'name' => __('Demoted user first name', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'demoted_user_last_name',
					'name' => __('Demoted user last name', 'notification-buddypress'),
					'property_name' => 'demotedUserObject',
					'group' => __('User', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'demotion_datetime',
					'name' => __('Demotion date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
