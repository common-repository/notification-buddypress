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

use BracketSpace\Notification\BuddyPress\Dependencies\Composer\Package\PackageInterface;

/**
 * DVCS Downloader interface.
 *
 * @author James Titcumb <james@asgrim.com>
 */
interface DvcsDownloaderInterface
{
    /**
     * Checks for unpushed changes to a current branch
     *
     * @param  PackageInterface $package package instance
     * @param  string           $path    package directory
     * @return string|null      changes or null
     */
    public function getUnpushedChanges(PackageInterface $package, string $path): ?string;
}
