<?php
/**
 * Register Carriers.
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository;

use BracketSpace\Notification\Register;

/**
 * Carrier Repository.
 */
class CarrierRepository
{
	/**
	 * @return void
	 */
	public static function register()
	{
		if (! \Notification::settings()->getSetting('carriers/buddypress/enable')) {
			return;
		}

		Register::carrier(new Carrier\BuddyPressNotification());
	}
}
