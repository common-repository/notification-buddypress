<?php
/**
 * @license MIT
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BracketSpace\Notification\BuddyPress\Dependencies\Composer\Downloader;

use BracketSpace\Notification\BuddyPress\Dependencies\React\Promise\PromiseInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\Composer\Package\PackageInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\Composer\Util\ProcessExecutor;

/**
 * Xz archive downloader.
 *
 * @author Pavel Puchkin <i@neoascetic.me>
 * @author Pierre Rudloff <contact@rudloff.pro>
 */
class XzDownloader extends ArchiveDownloader
{
    protected function extract(PackageInterface $package, string $file, string $path): PromiseInterface
    {
        $command = 'tar -xJf ' . ProcessExecutor::escape($file) . ' -C ' . ProcessExecutor::escape($path);

        if (0 === $this->process->execute($command, $ignoredOutput)) {
            return \BracketSpace\Notification\BuddyPress\Dependencies\React\Promise\resolve(null);
        }

        $processError = 'Failed to execute ' . $command . "\n\n" . $this->process->getErrorOutput();

        throw new \RuntimeException($processError);
    }
}
