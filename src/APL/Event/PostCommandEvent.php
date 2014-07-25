<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Command\CommandInterface;
use APL\Response\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class PostCommandEvent extends Event
{
    /** @var CommandInterface */
    private $command;

    /** @var ResponseInterface */
    private $response;

    /**
     *
     * @param CommandInterface  $command
     * @param ResponseInterface $response
     */
    public function __construct(CommandInterface $command, ResponseInterface $response)
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
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
