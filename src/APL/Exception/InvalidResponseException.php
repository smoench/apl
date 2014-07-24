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

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class InvalidResponseException extends Exception
{
    /**
     *
     * @var Command
     */
    protected $command;

    /**
     *
     * @var mixed
     */
    protected $response;

    /**
     *
     * @param Command $command
     * @param mixed $response
     */
    public function __construct(Command $command, $response)
    {
        $this->command  = $command;
        $this->response = $response;
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
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
