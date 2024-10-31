<?php
/**
 * Settings
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Admin;

use BracketSpace\Notification\Utils\Settings\CoreFields;

/**
 * Settings class
 */
class Settings
{
	/**
	 * Registers trigger settings
	 *
	 * @action notification/settings/register 20
	 *
	 * @since  2.0.0
	 * @param  \BracketSpace\Notification\Utils\Settings $settings Settings API object.
	 * @return void
	 */
	public function registerTriggerSettings($settings)
	{
		$triggers = $settings->addSection(__('Triggers', 'notification-buddypress'), 'triggers');

		$triggers->addGroup(__('BuddyPress', 'notification-buddypress'), 'buddypress')
			->addField(
				[
					'name' => __('Activity Triggers', 'notification-buddypress'),
					'slug' => 'activity_enable',
					'default' => true,
					'addons' => [
						'label' => __('Enable activity triggers', 'notification-buddypress'),
					],
					'render' => [new CoreFields\Checkbox(), 'input'],
					'sanitize' => [new CoreFields\Checkbox(), 'sanitize'],
				]
			)
			->addField(
				[
					'name' => __('Friendship Triggers', 'notification-buddypress'),
					'slug' => 'friendship_enable',
					'default' => true,
					'addons' => [
						'label' => __('Enable friendship triggers', 'notification-buddypress'),
					],
					'render' => [new CoreFields\Checkbox(), 'input'],
					'sanitize' => [new CoreFields\Checkbox(), 'sanitize'],
				]
			)
			->addField(
				[
					'name' => __('Group Triggers', 'notification-buddypress'),
					'slug' => 'group_enable',
					'default' => true,
					'addons' => [
						'label' => __('Enable group triggers', 'notification-buddypress'),
					],
					'render' => [new CoreFields\Checkbox(), 'input'],
					'sanitize' => [new CoreFields\Checkbox(), 'sanitize'],
				]
			);
	}

	/**
	 * Registers carrier settings
	 *
	 * @action notification/settings/register 30
	 *
	 * @since  2.0.0
	 * @param  \BracketSpace\Notification\Utils\Settings $settings Settings API object.
	 * @return void
	 */
	public function registerCarrierSettings($settings)
	{
		$carriers = $settings->addSection(__('Carriers', 'notification-buddypress'), 'carriers');

		$carriers->addGroup(__('BuddyPress', 'notification-buddypress'), 'buddypress')
			->addField(
				[
					'name' => __('Enable', 'notification-buddypress'),
					'slug' => 'enable',
					'default' => 'true',
					'addons' => [
						'label' => __('Enable BuddyPress Carrier', 'notification-buddypress'),
					],
					'render' => [new CoreFields\Checkbox(), 'input'],
					'sanitize' => [new CoreFields\Checkbox(), 'sanitize'],
				]
			);
	}
}
