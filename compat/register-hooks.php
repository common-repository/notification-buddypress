<?php
/**
 * Hooks compatibilty file.
 *
 * Automatically generated with `wp notification-buddypress dump-hooks`.
 *
 * @package notification/buddypress
 */

/** @var \BracketSpace\Notification\BuddyPress\Runtime $this */

// phpcs:disable
add_action('notification/init', [$this, 'elements'], 10, 0);
add_action('init', [$this->component('BracketSpace\Notification\BuddyPress\Dependencies\Micropackage\Internationalization\Internationalization'), 'load_translation'], 10, 0);
add_action('notification/settings/register', [$this->component('BracketSpace\Notification\BuddyPress\Admin\Settings'), 'registerTriggerSettings'], 20, 1);
add_action('notification/settings/register', [$this->component('BracketSpace\Notification\BuddyPress\Admin\Settings'), 'registerCarrierSettings'], 30, 1);
add_filter('bp_notifications_get_registered_components', [$this->component('BracketSpace\Notification\BuddyPress\Frontend\NotificationHandler'), 'registerComponent'], 10, 1);
add_filter('bp_notifications_get_notifications_for_user', [$this->component('BracketSpace\Notification\BuddyPress\Frontend\NotificationHandler'), 'handleNotification'], 10, 8);
