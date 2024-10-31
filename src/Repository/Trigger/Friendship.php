<?php
/**
 * Friendship trigger abstract
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger;

use BracketSpace\Notification\Repository\Trigger\BaseTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Friendship trigger class
 */
abstract class Friendship extends BaseTrigger
{
	/**
	 * User instance that initiated the friendship.
	 *
	 * @var  \WP_User
	 */
	public $friendshipInitiatorUserObject;

	/**
	 * User instance that friendship was requested to.
	 *
	 * @var  \WP_User
	 */
	public $friendshipFriendUserObject;

	/**
	 * Constructor
	 *
	 * @param array<string, mixed> $params Trigger configuration params.
	 */
	public function __construct($params = [])
	{
		if (
			!isset($params['slug'], $params['name']) ||
			!is_string($params['slug']) ||
			!is_string($params['name'])
		) {
			trigger_error('Friendship trigger requires slug and name params.', E_USER_ERROR);
		}

		parent::__construct($params['slug'], $params['name']);

		$this->setGroup(__('BuddyPress : Friendship', 'notification-buddypress'));
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		// Initiator user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'initiator_user_ID',
					'name' => __('Initiator user ID', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'initiator_user_login',
					'name' => __('Initiator user login', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'initiator_user_email',
					'name' => __('Initiator user email', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'initiator_user_display_name',
					'name' => __('Initiator user display name', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'initiator_user_first_name',
					'name' => __('Initiator user first name', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'initiator_user_last_name',
					'name' => __('Initiator user last name', 'notification-buddypress'),
					'property_name' => 'friendshipInitiatorUserObject',
					'group' => __('Initiator', 'notification-buddypress'),
				]
			)
		);

		// Friend user.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'friend_user_ID',
					'name' => __('Friend user ID', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'friend_user_login',
					'name' => __('Friend user login', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'friend_user_email',
					'name' => __('Friend user email', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'friend_user_display_name',
					'name' => __('Friend user display name', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'friend_user_first_name',
					'name' => __('Friend user first name', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'friend_user_last_name',
					'name' => __('Friend user last name', 'notification-buddypress'),
					'property_name' => 'friendshipFriendUserObject',
					'group' => __('Friend', 'notification-buddypress'),
				]
			)
		);
	}
}
