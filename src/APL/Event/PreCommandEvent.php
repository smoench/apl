<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Command;

class PreCommandEvent
{
    /** @var Command */
    private $command;

    /**
     *
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }
}
