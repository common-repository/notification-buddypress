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

namespace BracketSpace\Notification\BuddyPress\Dependencies\Composer\Plugin;

use BracketSpace\Notification\BuddyPress\Dependencies\Composer\EventDispatcher\Event;
use BracketSpace\Notification\BuddyPress\Dependencies\Symfony\Component\Console\Input\InputInterface;

/**
 * The pre command run event.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class PreCommandRunEvent extends Event
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var string
     */
    private $command;

    /**
     * Constructor.
     *
     * @param string         $name    The event name
     * @param string         $command The command about to be executed
     */
    public function __construct(string $name, InputInterface $input, string $command)
    {
        parent::__construct($name);
        $this->input = $input;
        $this->command = $command;
    }

    /**
     * Returns the console input
     */
    public function getInput(): InputInterface
    {
        return $this->input;
    }

    /**
     * Returns the command about to be executed
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
