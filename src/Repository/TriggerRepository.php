<?php
/**
 * Register Triggers.
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository;

use BracketSpace\Notification\Register;

/**
 * Trigger Repository.
 */
class TriggerRepository
{
	/**
	 * @return void
	 */
	public static function register()
	{
		// Activity.
		if (\Notification::settings()->getSetting('triggers/buddypress/activity_enable')) {
			Register::trigger(new Trigger\Activity\Added());
			Register::trigger(new Trigger\Activity\Deleted());
			Register::trigger(new Trigger\Activity\AddToFavorities());
			Register::trigger(new Trigger\Activity\AddToFavoritiesFail());
			Register::trigger(new Trigger\Activity\RemoveFromFavorities());
		}

		// Friendship.
		if (\Notification::settings()->getSetting('triggers/buddypress/friendship_enable')) {
			Register::trigger(new Trigger\Friendship\Accepted());
			Register::trigger(new Trigger\Friendship\Requested());
			Register::trigger(new Trigger\Friendship\Deleted());
		}

		// Group.
		// phpcs:ignore SlevomatCodingStandard.ControlStructures.EarlyExit.EarlyExitNotUsed
		if (!\Notification::settings()->getSetting('triggers/buddypress/group_enable')) {
			Register::trigger(new Trigger\Group\CreateComplete());
			Register::trigger(new Trigger\Group\DetailsUpdated());
			Register::trigger(new Trigger\Group\SettingsUpdated());
			Register::trigger(new Trigger\Group\Deleted());

			Register::trigger(new Trigger\Group\InviteUser());
			Register::trigger(new Trigger\Group\UninviteUser());
			Register::trigger(new Trigger\Group\Join());
			Register::trigger(new Trigger\Group\Leave());
			Register::trigger(new Trigger\Group\RemoveMember());

			Register::trigger(new Trigger\Group\BanMember());
			Register::trigger(new Trigger\Group\UnbanMember());

			Register::trigger(new Trigger\Group\PromoteMember());
			Register::trigger(new Trigger\Group\DemoteMember());

			Register::trigger(new Trigger\Group\MembershipRequested());
			Register::trigger(new Trigger\Group\MembershipAccepted());
			Register::trigger(new Trigger\Group\MembershipRejected());
		}
	}
}
