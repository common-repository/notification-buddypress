<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\BuddyPress\Dependencies\League\Flysystem;

use RuntimeException;

final class CorruptedPathDetected extends RuntimeException implements FilesystemException
{
    public static function forPath(string $path): CorruptedPathDetected
    {
        return new CorruptedPathDetected("Corrupted path detected: " . $path);
    }
}
