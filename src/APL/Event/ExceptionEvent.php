<?php

/**
 *
 * Copyright 2014 simon.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use Exception;
use APL\Command\CommandInterface;
use APL\Response\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class ExceptionEvent extends Event
{
    /** @var CommandInterface */
    private $command;

    /** @var Exception */
    private $exception;

    /** @var ResponseInterface|null */
    private $response = null;

    /**
     *
     * @param CommandInterface $command
     * @param Exception $exception
     */
    public function __construct(CommandInterface $command, Exception $exception)
    {
        $this->command   = $command;
        $this->exception = $exception;
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
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }
}
