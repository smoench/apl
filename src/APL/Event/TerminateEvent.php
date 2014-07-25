<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Response\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class TerminateEvent extends Event
{
    /** @var ResponseInterface */
    private $response;

    /**
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
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
