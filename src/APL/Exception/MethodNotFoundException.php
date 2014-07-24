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
use APL\UseCase;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class MethodNotFoundException extends Exception
{
    /**
     *
     * @var Command
     */
    protected $command;

    /**
     *
     * @var UseCase
     */
    protected $useCase;

    /**
     *
     * @var string
     */
    protected $method;

    /**
     *
     * @param Command $command
     * @param UseCase $useCase
     * @param string  $method
     */
    public function __construct(Command $command, UseCase $useCase, $method)
    {
        $this->command = $command;
        $this->useCase = $useCase;
        $this->method  = $method;
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
     * @return UseCase
     */
    public function getUseCase()
    {
        return $this->useCase;
    }

    /**
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
