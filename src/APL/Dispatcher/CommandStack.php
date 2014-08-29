<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Dispatcher;

use APL\Command\CommandInterface;

/**
 *
 * @author David Badura <badura@simplethings.de>
 */
class CommandStack
{

    /**
     *
     * @var CommandInterface[]
     */
    private $commands = array();

    /**
     *
     * @param CommandInterface $command
     */
    public function push(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

    /**
     *
     * @return CommandInterface
     */
    public function pop()
    {
        if (!$this->commands) {
            return null;
        }

        return array_pop($this->commands);
    }

    /**
     *
     * @return CommandInterface
     */
    public function getCurrentCommand()
    {
        return end($this->commands) ?: null;
    }

    /**
     *
     * @return CommandInterface
     */
    public function getMasterCommand()
    {
        if (!$this->commands) {
            return null;
        }

        return $this->commands[0];
    }

    /**
     *
     * @return CommandInterface
     */
    public function getParentCommand()
    {
        $pos = count($this->commands) - 2;

        if (!isset($this->commands[$pos])) {
            return null;
        }

        return $this->commands[$pos];
    }
}
