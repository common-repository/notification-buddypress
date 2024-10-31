<?php
/**
 * Activity trigger abstract
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger;

use BracketSpace\Notification\Repository\Trigger\BaseTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Activity trigger class
 */
abstract class Activity extends BaseTrigger
{
	/**
	 * Activity instance.
	 *
	 * @var  \BP_Activity_Activity
	 */
	public $activity;

	/**
	 * User instance that relates to activity by "favorite" action.
	 *
	 * @var  \WP_User
	 */
	public $favoringUserObject;

	/**
	 * User instance related to activity.
	 *
	 * @var  \WP_User
	 */
	public $activityUserObject;

	/**
	 * Constructor
	 *
	 * @param array<string, mixed> $params Trigger configuration params.
	 */
	public function __construct($params = [])
	{
		if (
			!isset($params['slug'], $params['name']) ||
			!is_string($params['slug']) ||
			!is_string($params['name'])
		) {
			trigger_error('Activity trigger requires slug and name params.', E_USER_ERROR);
		}

		parent::__construct($params['slug'], $params['name']);

		$this->setGroup(__('BuddyPress : Activity', 'notification-buddypress'));
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		// Activity.
		$this->addMergeTag(
			new MergeTag\UrlTag(
				[
					'slug' => 'activity_primary_link',
					'name' => __('Activity primary link', 'notification-buddypress'),
					'group' => __('Activity', 'notification-buddypress'),
					'resolver' => static function (Activity $trigger) {
						return bp_activity_get_permalink($trigger->activity->id);
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'activity_content',
					'name' => __('Activity content', 'notification-buddypress'),
					'group' => __('Activity', 'notification-buddypress'),
					'description' => 'My Super News is awesome!',
					'example' => true,
					'resolver' => static function (Activity $trigger) {
						return $trigger->activity->content;
					},
				]
			)
		);

		// Activity author.
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'activity_user_ID',
					'name' => __('Activity user ID', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'activity_user_login',
					'name' => __('Activity user login', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'activity_user_email',
					'name' => __('Activity user email', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'activity_user_display_name',
					'name' => __('Activity user display name', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'activity_user_first_name',
					'name' => __('Activity user first name', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'activity_user_last_name',
					'name' => __('Activity user last name', 'notification-buddypress'),
					'property_name' => 'activityUserObject',
					'group' => __('Activity author', 'notification-buddypress'),
				]
			)
		);
	}

	/**
	 * Registers favoring user merge tags
	 *
	 * @uses $this->favoringUserObject User object property.
	 * @return void
	 */
	public function favoringUserMergeTags()
	{
		$this->addMergeTag(
			new MergeTag\User\UserID(
				[
					'slug' => 'favoring_user_ID',
					'name' => __('Favoring user ID', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLogin(
				[
					'slug' => 'favoring_user_login',
					'name' => __('Favoring user login', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserEmail(
				[
					'slug' => 'favoring_user_email',
					'name' => __('Favoring user email', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserDisplayName(
				[
					'slug' => 'favoring_user_display_name',
					'name' => __('Favoring user display name', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserFirstName(
				[
					'slug' => 'favoring_user_first_name',
					'name' => __('Favoring user first name', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\User\UserLastName(
				[
					'slug' => 'favoring_user_last_name',
					'name' => __('Favoring user last name', 'notification-buddypress'),
					'property_name' => 'favoringUserObject',
					'group' => __('Favoring user', 'notification-buddypress'),
				]
			)
		);
	}
}
