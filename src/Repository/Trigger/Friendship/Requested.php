<?php
/**
 * Friendship requested trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Friendship requested trigger class
 */
class Requested extends FriendshipTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/friendship/requested',
				'name' => __('Friendship requested', 'notification-buddypress'),
			]
		);

		$this->addAction('friends_friendship_requested', 10, 3);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $friendshipId              ID of the pending friendship object.
	 * @param int $friendshipInitiatorUserId ID of the friendship initiator.
	 * @param int $friendshipFriendUserId    ID of the user requested friendship with.
	 * @return mixed
	 */
	public function context($friendshipId, $friendshipInitiatorUserId, $friendshipFriendUserId)
	{
		$friendshipInitiatorUser = get_user_by('id', $friendshipInitiatorUserId);
		$friendshipFriendUser = get_user_by('id', $friendshipFriendUserId);

		if (!$friendshipInitiatorUser instanceof \WP_User || !$friendshipFriendUser instanceof \WP_User) {
			return false;
		}

		$this->friendshipInitiatorUserObject = $friendshipInitiatorUser;
		$this->friendshipFriendUserObject = $friendshipFriendUser;
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
			new MergeTag\DateTime\DateTime(
				[
					'slug' => 'friendship_request_datetime',
					'name' => __('Friendship request date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\UrlTag(
				[
					'slug' => 'friend_requests_url',
					'name' => __('Friend requests URL', 'notification-buddypress'),
					'description' => __('Leads to friend requests page of the invited user', 'notification-buddypress'),
					'group' => __('Friend', 'notification-buddypress'),
					'resolver' => static function ($trigger) {
						$url = sprintf(
							'%s%s/requests/',
							bp_core_get_user_domain($trigger->friendshipFriendUserObject->ID),
							bp_get_friends_slug()
						);

						return esc_url($url);
					},
				]
			)
		);
	}
}
