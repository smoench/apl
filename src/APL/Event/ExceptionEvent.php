<?php

/**
 *
 * Copyright 2014 simon.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Command;

class ExceptionEvent
{
    /** @var Command */
    private $command;

    /** @var \Exception */
    private $exception;

    /** @var Response|null */
    private $response = null;

    public function __construct(Command $command, \Exception $exception)
    {
        $this->command = $command;
        $this->exception = $exception;
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
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * 
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * 
     * @param array $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
