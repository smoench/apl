<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Exception;

use APL\UseCase\UseCaseInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class DuplicateUseCaseException extends Exception
{
    /**
     *
     * @var UseCaseInterface
     */
    protected $firstUseCase;

    /**
     *
     * @var UseCaseInterface
     */
    protected $secondUseCase;

    /**
     *
     * @var string
     */
    protected $commandClass;

    /**
     *
     * @param UseCaseInterface $firstUseCase
     * @param UseCaseInterface $secondUseCase
     * @param string           $commandClass
     */
    public function __construct(UseCaseInterface $firstUseCase, UseCaseInterface $secondUseCase, $commandClass)
    {
        $this->firstUseCase  = $firstUseCase;
        $this->secondUseCase = $secondUseCase;
        $this->commandClass  = $commandClass;
    }

    /**
     *
     * @return UseCaseInterface
     */
    public function getFirstUseCase()
    {
        return $this->firstUseCase;
    }

    /**
     *
     * @return UseCaseInterface
     */
    public function getSecondUseCase()
    {
        return $this->secondUseCase;
    }

    /**
     *
     * @return string
     */
    public function getCommandClass()
    {
        return $this->commandClass;
    }
}
