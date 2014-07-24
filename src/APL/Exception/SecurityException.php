<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Exception;

use APL\Command;
use APL\Security\Policy;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class SecurityException extends Exception
{
    /**
     *
     * @var Command
     */
    protected $command;

    /**
     *
     * @var Policy
     */
    protected $policy;

    /**
     *
     * @param Command $command
     * @param Policy $policy
     */
    public function __construct(Command $command, Policy $policy)
    {
        $this->command = $command;
        $this->policy  = $policy;
    }

    /**
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     *
     * @return Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }
}
