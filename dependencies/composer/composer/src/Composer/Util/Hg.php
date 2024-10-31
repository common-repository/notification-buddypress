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

namespace BracketSpace\Notification\BuddyPress\Dependencies\Composer\Util;

use BracketSpace\Notification\BuddyPress\Dependencies\Composer\Config;
use BracketSpace\Notification\BuddyPress\Dependencies\Composer\IO\IOInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\Composer\Pcre\Preg;

/**
 * @author Jonas Renaudot <jonas.renaudot@gmail.com>
 */
class Hg
{
    /** @var string|false|null */
    private static $version = false;

    /**
     * @var \BracketSpace\Notification\BuddyPress\Dependencies\Composer\IO\IOInterface
     */
    private $io;

    /**
     * @var \BracketSpace\Notification\BuddyPress\Dependencies\Composer\Config
     */
    private $config;

    /**
     * @var \BracketSpace\Notification\BuddyPress\Dependencies\Composer\Util\ProcessExecutor
     */
    private $process;

    public function __construct(IOInterface $io, Config $config, ProcessExecutor $process)
    {
        $this->io = $io;
        $this->config = $config;
        $this->process = $process;
    }

    public function runCommand(callable $commandCallable, string $url, ?string $cwd): void
    {
        $this->config->prohibitUrlByConfig($url, $this->io);

        // Try as is
        $command = $commandCallable($url);

        if (0 === $this->process->execute($command, $ignoredOutput, $cwd)) {
            return;
        }

        // Try with the authentication information available
        if (
            Preg::isMatch('{^(?P<proto>ssh|https?)://(?:(?P<user>[^:@]+)(?::(?P<pass>[^:@]+))?@)?(?P<host>[^/]+)(?P<path>/.*)?}mi', $url, $matches)
            && $this->io->hasAuthentication((string) $matches['host'])
        ) {
            if ($matches['proto'] === 'ssh') {
                $user = '';
                if ($matches['user'] !== '' && $matches['user'] !== null) {
                    $user = rawurlencode($matches['user']) . '@';
                }
                $authenticatedUrl = $matches['proto'] . '://' . $user . $matches['host'] . $matches['path'];
            } else {
                $auth = $this->io->getAuthentication((string) $matches['host']);
                $authenticatedUrl = $matches['proto'] . '://' . rawurlencode($auth['username']) . ':' . rawurlencode($auth['password']) . '@' . $matches['host'] . $matches['path'];
            }
            $command = $commandCallable($authenticatedUrl);

            if (0 === $this->process->execute($command, $ignoredOutput, $cwd)) {
                return;
            }

            $error = $this->process->getErrorOutput();
        } else {
            $error = 'The given URL (' .$url. ') does not match the required format (ssh|http(s)://(username:password@)example.com/path-to-repository)';
        }

        $this->throwException("Failed to clone $url, \n\n" . $error, $url);
    }

    /**
     * @param non-empty-string $message
     *
     * @return never
     */
    private function throwException($message, string $url): void
    {
        if (null === self::getVersion($this->process)) {
            throw new \RuntimeException(Url::sanitize(
                'Failed to clone ' . $url . ', hg was not found, check that it is installed and in your PATH env.' . "\n\n" . $this->process->getErrorOutput()
            ));
        }

        throw new \RuntimeException(Url::sanitize($message));
    }

    /**
     * Retrieves the current hg version.
     *
     * @return string|null The hg version number, if present.
     */
    public static function getVersion(ProcessExecutor $process): ?string
    {
        if (false === self::$version) {
            self::$version = null;
            if (0 === $process->execute('hg --version', $output) && Preg::isMatch('/^.+? (\d+(?:\.\d+)+)(?:\+.*?)?\)?\r?\n/', $output, $matches)) {
                self::$version = $matches[1];
            }
        }

        return self::$version;
    }
}
