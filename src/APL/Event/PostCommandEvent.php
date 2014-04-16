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
use APL\Response;

class PostCommandEvent
{
    /** @var Command */
    private $command;

    /** @var Response */
    private $response;

    /**
     * 
     * @param Command $command
     * @param Response $response
     */
    public function __construct(Command $command, Response $response)
    {
        $this->command = $command;
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
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
