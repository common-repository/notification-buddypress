<?php

namespace BracketSpace\Notification\BuddyPress\Dependencies\BrianHenryIE\Strauss\Console;

use BracketSpace\Notification\BuddyPress\Dependencies\BrianHenryIE\Strauss\Console\Commands\Compose;
use BracketSpace\Notification\BuddyPress\Dependencies\Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * @param string $version
     */
    public function __construct(string $version)
    {
        parent::__construct('strauss', $version);

        $composeCommand = new Compose();
        $this->add($composeCommand);

        $this->setDefaultCommand('compose');
    }
}
