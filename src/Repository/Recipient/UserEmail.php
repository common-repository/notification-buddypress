<?php
/**
 * User Email recipient
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Recipient;

use BracketSpace\Notification\Repository\Recipient\BaseRecipient;
use BracketSpace\Notification\Repository\Field;

/**
 * User Email recipient
 */
class UserEmail extends BaseRecipient
{
	/**
	 * Recipient constructor
	 *
	 * @since 5.0.0
	 */
	public function __construct()
	{
		parent::__construct(
			[
				'slug' => 'user_email',
				'name' => __('User by email', 'notification-buddypress'),
				'default_value' => '',
			]
		);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param  string $value raw value saved by the user.
	 * @return array<int>         array of resolved values
	 */
	public function parseValue($value = '')
	{
		if (empty($value)) {
			return [];
		}

		$emails = array_map('trim', explode(',', $value));
		$ids = [];

		foreach ($emails as $email) {
			$user = get_user_by('email', $email);

			if (!$user instanceof \WP_User) {
				continue;
			}

			$ids[] = $user->ID;
		}

		return $ids;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return object
	 */
	public function input()
	{

		return new Field\InputField(
			[
				'label' => __('Recipient', 'notification-buddypress'),
				'name' => 'recipient',
				'css_class' => 'recipient-value',
				'value' => $this->getDefaultValue(),
				'placeholder' => __('admin@example.com or {user_email}', 'notification-buddypress'),
				'description' => __('You can use any valid email merge tag.', 'notification-buddypress'),
			]
		);
	}
}
