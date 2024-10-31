<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\BuddyPress\Dependencies\JsonSchema\Constraints\TypeCheck;

interface TypeCheckInterface
{
    public static function isObject($value);

    public static function isArray($value);

    public static function propertyGet($value, $property);

    public static function propertySet(&$value, $property, $data);

    public static function propertyExists($value, $property);

    public static function propertyCount($value);
}
