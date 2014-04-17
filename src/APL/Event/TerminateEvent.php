<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Response;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class TerminateEvent
{
    /** @var Response */
    private $response;

    /**
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     *
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
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
