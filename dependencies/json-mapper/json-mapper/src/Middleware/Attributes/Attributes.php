<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Middleware\Attributes;

use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\JsonMapperInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Middleware\AbstractMiddleware;
use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\ValueObjects\PropertyMap;
use BracketSpace\Notification\BuddyPress\Dependencies\JsonMapper\Wrapper\ObjectWrapper;

class Attributes extends AbstractMiddleware
{
    public function handle(
        \stdClass $json,
        ObjectWrapper $object,
        PropertyMap $propertyMap,
        JsonMapperInterface $mapper
    ): void {
        foreach ($object->getReflectedObject()->getProperties() as $property) {
            $attributes = $property->getAttributes(MapFrom::class);

            foreach ($attributes as $attribute) {
                /** @var MapFrom $mapFrom */
                $mapFrom = $attribute->newInstance();
                $source = $mapFrom->source;
                $target = $property->name;

                if ($source === $target) {
                    continue;
                }

                if (isset($json->$source)) {
                    $json->$target = $json->$source;
                    unset($json->$source);
                }
            }
        }
    }
}
