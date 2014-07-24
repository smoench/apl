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
    protected $fistUseCase;

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
     * @param UseCase $fistUseCase
     * @param UseCase $secondUseCase
     * @param string  $commandClass
     */
    public function __construct(UseCase $fistUseCase, UseCase $secondUseCase, $commandClass)
    {
        $this->fistUseCase   = $fistUseCase;
        $this->secondUseCase = $secondUseCase;
        $this->commandClass  = $commandClass;
    }

    /**
     *
     * @return UseCase
     */
    public function getFistUseCase()
    {
        return $this->fistUseCase;
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
