<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Middleware;

use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\JsonMapperInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\ValueObjects\PropertyMap;
use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Wrapper\ObjectWrapper;

abstract class AbstractMiddleware implements MiddlewareInterface, MiddlewareLogicInterface
{
    public function __invoke(callable $handler): callable
    {
        return function (
            \stdClass $json,
            ObjectWrapper $object,
            PropertyMap $map,
            JsonMapperInterface $mapper
        ) use (
            $handler
        ) {
            $this->handle($json, $object, $map, $mapper);

            $handler($json, $object, $map, $mapper);
        };
    }

    abstract public function handle(
        \stdClass $json,
        ObjectWrapper $object,
        PropertyMap $propertyMap,
        JsonMapperInterface $mapper
    ): void;
}
