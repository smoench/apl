<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Exception;

use APL\UseCase;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class DuplicateUseCaseException extends Exception
{
    /**
     *
     * @var UseCase
     */
    protected $firstUseCase;

    /**
     *
     * @var UseCase
     */
    protected $secondUseCase;

    /**
     *
     * @var string
     */
    protected $commandClass;

    /**
     *
     * @param UseCase $firstUseCase
     * @param UseCase $secondUseCase
     * @param string  $commandClass
     */
    public function __construct(UseCase $firstUseCase, UseCase $secondUseCase, $commandClass)
    {
        $this->firstUseCase  = $firstUseCase;
        $this->secondUseCase = $secondUseCase;
        $this->commandClass  = $commandClass;
    }

    /**
     *
     * @return UseCase
     */
    public function getFirstUseCase()
    {
        return $this->firstUseCase;
    }

    /**
     *
     * @return UseCase
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
