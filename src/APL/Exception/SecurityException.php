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
use APL\Security\PolicyInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class SecurityException extends Exception
{
    /**
     *
     * @var CommandInterface
     */
    protected $command;

    /**
     *
     * @var PolicyInterface
     */
    protected $policy;

    /**
     *
     * @param CommandInterface $command
     * @param PolicyInterface $policy
     */
    public function __construct(CommandInterface $command, PolicyInterface $policy)
    {
        $this->command = $command;
        $this->policy  = $policy;
    }

    /**
     *
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     *
     * @return PolicyInterface
     */
    public function getPolicy()
    {
        return $this->policy;
    }
}
