<?php
/**
 * Notification handler
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Frontend;

/**
 * NotificationHandler class
 */
class NotificationHandler
{
	/**
	 * Registers BuddyPress Component.
	 *
	 * @filter bp_notifications_get_registered_components
	 *
	 * @since  1.2.1
	 * @param  array<string> $components Registered components.
	 * @return array<string>
	 */
	public function registerComponent($components = [])
	{
		array_push($components, 'notification-buddypress');

		return $components;
	}

	/**
	 * Displays BuddyPress notification.
	 *
	 * @filter bp_notifications_get_notifications_for_user
	 *
	 * @since  1.2.1
	 * @param  string $content               Notification content.
	 * @param  int    $itemId               Notifiable item ID.
	 * @param  int    $secondaryItemId     Notifiable secondary item ID.
	 * @param  int    $totalItems           Total items.
	 * @param  string $format                Notification format.
	 * @param  string $componentActionName Component action name.
	 * @param  string $componentName        Component name.
	 * @param  int    $id                    Notification ID.
	 * @return string|array<mixed>
	 */
	public function handleNotification(
		$content,
		$itemId,
		$secondaryItemId,
		$totalItems,
		$format,
		$componentActionName,
		$componentName,
		$id
	) {
		if ($componentName !== 'notification-buddypress') {
			return $content;
		}

		/** @var string */
		$text = bp_notifications_get_meta($id, 'notification_content', true);
		$link = bp_notifications_get_meta($id, 'notification_link', true);

		if ($format === 'string') {
			$content = $link ? '<a href="' . $link . '">' . $text . '</a>' : $text;
		} else {
			$content = [
				'text' => $text,
				'link' => $link,
			];
		}

		return $content;
	}
}
