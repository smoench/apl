<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Command\CommandInterface;
use Symfony\Component\EventDispatcher\Event;

class PreCommandEvent extends Event
{
    /** @var CommandInterface */
    private $command;

    /**
     *
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     *
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }
}
