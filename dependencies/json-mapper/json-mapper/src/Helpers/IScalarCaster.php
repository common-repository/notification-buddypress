<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Helpers;

use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Enums\ScalarType;

interface IScalarCaster
{
    /** @return string|bool|int|float */
    public function cast(ScalarType $scalarType, $value);
}
