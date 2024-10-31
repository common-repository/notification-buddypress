<?php
/**
 * Group trigger abstract
 *
 * @package notification/buddypress
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Repository\Trigger;

use BracketSpace\Notification\Repository\Trigger\BaseTrigger;
use BracketSpace\Notification\Repository\MergeTag;

/**
 * Group trigger class
 */
abstract class Group extends BaseTrigger
{
	/**
	 * Group instance.
	 *
	 * @var  \BP_Groups_Group
	 */
	public $buddyGroup;

	/**
	 * Constructor
	 *
	 * @param array<mixed> $params Trigger configuration params.
	 */
	public function __construct($params = [])
	{
		if (
			!isset($params['slug'], $params['name']) ||
			!is_string($params['slug']) ||
			!is_string($params['name'])
		) {
			trigger_error('Group trigger requires slug and name params.', E_USER_ERROR);
		}

		parent::__construct($params['slug'], $params['name']);

		$this->setGroup(__('BuddyPress : Group', 'notification-buddypress'));
	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function mergeTags()
	{
		$this->addMergeTag(
			new MergeTag\IntegerTag(
				[
					'slug' => 'group_ID',
					'name' => __('Group ID', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => 123,
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->id;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\IntegerTag(
				[
					'slug' => 'group_parent_ID',
					'name' => __('Group parent ID', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => 123,
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->parent_id;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\IntegerTag(
				[
					'slug' => 'group_creator_ID',
					'name' => __('Group creator ID', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => 123,
					'example' => true,
					'resolver' => static function ($trigger) {
						return $trigger->buddyGroup->creator_id;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'group_name',
					'name' => __('Group name', 'notification-buddypress'),
					'description' => __('My Super Example Group', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->name;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'group_slug',
					'name' => __('Group slug', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => 'my-super-example-group',
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->slug;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'group_description',
					'name' => __('Group description', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => 'My Super Example Group is awesome!',
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->description;
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'group_status',
					'name' => __('Group status', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'resolver' => static function (Group $trigger) {
						return ucfirst($trigger->buddyGroup->status);
					},
				]
			)
		);

		$this->addMergeTag(
			new MergeTag\StringTag(
				[
					'slug' => 'group_forum_enabled',
					'name' => __('Group forum enabled', 'notification-buddypress'),
					'group' => __('Group', 'notification-buddypress'),
					'description' => __('Returns: Enabled or Disabled', 'notification-buddypress'),
					'example' => true,
					'resolver' => static function (Group $trigger) {
						return $trigger->buddyGroup->enable_forum === '1'
							? __('Enabled', 'notification-buddypress')
							: __('Disabled', 'notification-buddypress');
					},
				]
			)
		);
	}
}
