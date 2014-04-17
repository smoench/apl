<?php

namespace APL\Exception;

use APL\Command;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class UseCaseNotFoundException extends Exception
{

    /**
     *
     * @var Command
     */
    protected $command;

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
