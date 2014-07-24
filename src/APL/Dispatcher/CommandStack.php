<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Dispatcher;

use APL\Command;

/**
 *
 * @author David Badura <badura@simplethings.de>
 */
class CommandStack
{

    /**
     *
     * @var Command[]
     */
    private $commands = array();

    /**
     *
     * @param Command $command
     */
    public function push(Command $command)
    {
        $this->commands[] = $command;
    }

    /**
     *
     * @return Command
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
     * @return Command
     */
    public function getCurrentCommand()
    {
        return end($this->commands) ?: null;
    }

    /**
     *
     * @return Command
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
     * @return Command
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
