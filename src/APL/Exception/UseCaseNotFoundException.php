<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Exception;

use APL\Command\CommandInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class UseCaseNotFoundException extends Exception
{
    /**
     *
     * @var CommandInterface
     */
    protected $command;

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
