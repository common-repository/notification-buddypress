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
use BracketSpace\Notification\BuddyPress\Dependencies\Psr\Log\LoggerInterface;

class Debugger extends AbstractMiddleware
{
    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(
        \stdClass $json,
        ObjectWrapper $object,
        PropertyMap $propertyMap,
        JsonMapperInterface $mapper
    ): void {
        $this->logger->debug(
            'Current state attributes passed through JsonMapper middleware',
            [
                'json' => \json_encode($json),
                'object' => $object->getName(),
                'propertyMap' => $propertyMap->toString()
            ]
        );
    }
}
