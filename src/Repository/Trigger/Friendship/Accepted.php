<?php
/**
 * Friendship accepted trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Friendship accepted trigger class
 */
class Accepted extends FriendshipTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/friendship/accepted',
				'name' => __('Friendship accepted', 'notification-buddypress'),
			]
		);

		$this->addAction('friends_friendship_accepted', 10, 3);
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
					'slug' => 'friendship_acceptance_datetime',
					'name' => __('Friendship acceptance date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
