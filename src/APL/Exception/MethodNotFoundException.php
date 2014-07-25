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
use APL\UseCase\UseCaseInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class MethodNotFoundException extends Exception
{
    /**
     *
     * @var CommandInterface
     */
    protected $command;

    /**
     *
     * @var UseCaseInterface
     */
    protected $useCase;

    /**
     *
     * @var string
     */
    protected $method;

    /**
     *
     * @param CommandInterface $command
     * @param UseCaseInterface $useCase
     * @param string           $method
     */
    public function __construct(CommandInterface $command, UseCaseInterface $useCase, $method)
    {
        $this->command = $command;
        $this->useCase = $useCase;
        $this->method  = $method;
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
     * @return UseCaseInterface
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
