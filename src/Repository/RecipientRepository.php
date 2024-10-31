<?php
/**
 * Register Recipients.
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository;

use BracketSpace\Notification\Register;
use BracketSpace\Notification\Repository\Recipient as BaseRecipient;

/**
 * Recipient Repository.
 */
class RecipientRepository
{
	/**
	 * @return void
	 */
	public static function register()
	{
		Register::recipient('buddypress-notification', new BaseRecipient\Role(['return_field' => 'ID']));
		Register::recipient('buddypress-notification', new BaseRecipient\User(['return_field' => 'ID']));
		Register::recipient('buddypress-notification', new BaseRecipient\UserID(['return_field' => 'ID']));
		Register::recipient('buddypress-notification', new Recipient\UserEmail());
	}
}
