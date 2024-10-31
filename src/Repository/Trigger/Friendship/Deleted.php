<?php
/**
 * Friendship deleted trigger
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship;

use BracketSpace\Notification\BuddyPress\Repository\Trigger\Friendship as FriendshipTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Friendship deleted trigger class
 */
class Deleted extends FriendshipTrigger
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'buddypress/friendship/deleted',
				'name' => __('Friendship deleted', 'notification-buddypress'),
			]
		);

		$this->addAction('friends_friendship_post_delete', 10, 2);
	}

	/**
	 * Hooks to the action.
	 *
	 * @param int $friendshipInitiatorUserId ID of the friendship initiator.
	 * @param int $friendshipFriendUserId    ID of the user requested friendship with.
	 * @return mixed
	 */
	public function context($friendshipInitiatorUserId, $friendshipFriendUserId)
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
					'slug' => 'friendship_deletion_datetime',
					'name' => __('Friendship deletion date and time', 'notification-buddypress'),
					'group' => __('Date', 'notification-buddypress'),
					'timestamp' => static function () {
						return time();
					},
				]
			)
		);
	}
}
