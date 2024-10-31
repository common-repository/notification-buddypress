<?php
/**
 * Plugin Name: Notification : BuddyPress
 * Description: BuddyPress integration with Notification plugin. Add Triggers for all BuddyPress actions.
 * Plugin URI: http://wordpress.org/plugins/notification-buddypress/
 * Author: BracketSpace
 * Author URI: https://bracketspace.com
 * Version: 3.0.0
 * License: GPL3
 * Text Domain: notification-buddypress
 * Domain Path: /languages
 * Requires Plugins: notification, buddypress
 *
 * @package notification/buddypress
 *
 * phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * phpcs:disable Squiz.Classes.ClassFileName.NoMatch
 */

declare(strict_types=1);

if (! class_exists('NotificationBuddyPress')) :

	/**
	 * NotificationBuddyPress class
	 */
	class NotificationBuddyPress
	{
		/**
		 * Runtime object
		 *
		 * @var ?BracketSpace\Notification\BuddyPress\Runtime
		 */
		protected static $runtime;

		/**
		 * Initializes the plugin runtime
		 *
		 * @since  2.0.0
		 * @param  string $pluginFile Main plugin file.
		 * @return BracketSpace\Notification\BuddyPress\Runtime
		 */
		public static function init($pluginFile)
		{
			if (self::$runtime === null) {
				// Autoloading.
				require_once dirname($pluginFile) . '/vendor/autoload.php';
				self::$runtime = new BracketSpace\Notification\BuddyPress\Runtime($pluginFile);
			}

			return self::$runtime;
		}

		/**
		 * Gets runtime component
		 *
		 * @since  2.0.0
		 * @return array<class-string,mixed>
		 */
		public static function components()
		{
			return self::$runtime !== null ? self::$runtime->components() : [];
		}

		/**
		 * Gets runtime component
		 *
		 * @since  2.0.0
		 * @param  string $componentName Component name.
		 * @return mixed
		 */
		public static function component($componentName)
		{
			return self::$runtime !== null ? self::$runtime->component($componentName) : null;
		}

		/**
		 * Gets runtime object
		 *
		 * @since  2.0.0
		 * @return ?BracketSpace\Notification\BuddyPress\Runtime
		 */
		public static function runtime()
		{
			return self::$runtime;
		}

		/**
		 * Gets plugin filesystem
		 *
		 * @since  2.0.0
		 * @throws \Exception When runtime wasn't invoked yet.
		 * @return \BracketSpace\Notification\BuddyPress\Dependencies\Micropackage\Filesystem\Filesystem
		 */
		public static function fs()
		{
			if (self::$runtime === null) {
				throw new \Exception('Runtime has not been invoked yet.');
			}

			return self::$runtime->getFilesystem();
		}
	}

endif;

add_action(
	'notification/init',
	static function () {
		NotificationBuddyPress::init(__FILE__)->init();
	},
	2
);
