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
class InvalidResponseException extends Exception
{
    /**
     *
     * @var CommandInterface
     */
    protected $command;

    /**
     *
     * @var mixed
     */
    protected $response;

    /**
     *
     * @param CommandInterface $command
     * @param mixed $response
     */
    public function __construct(CommandInterface $command, $response)
    {
        $this->command  = $command;
        $this->response = $response;
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
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
