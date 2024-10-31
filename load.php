<?php
/**
 * Load file
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

/**
 * Load the main plugin file.
 */
require_once __DIR__ . '/notification-buddypress.php';

/**
 * Initialize early.
 */
add_action(
	'notification/init',
	static function () {
		NotificationBuddyPress::init(__FILE__)->init();
	},
	1
);
