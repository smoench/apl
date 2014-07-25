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
    protected $alreadyRegisteredUseCase;

    /**
     *
     * @var UseCaseInterface
     */
    protected $duplicatedUseCase;

    /**
     *
     * @var string
     */
    protected $commandClass;

    /**
     *
     * @param UseCaseInterface $alreadyRegisteredUseCase
     * @param UseCaseInterface $duplicatedUseCase
     * @param string           $commandClass
     */
    public function __construct(UseCaseInterface $alreadyRegisteredUseCase, UseCaseInterface $duplicatedUseCase, $commandClass)
    {
        $this->firstUseCase      = $alreadyRegisteredUseCase;
        $this->duplicatedUseCase = $duplicatedUseCase;
        $this->commandClass      = $commandClass;
    }

    /**
     *
     * @return UseCaseInterface
     */
    public function getAlreadyRegisteredUseCase()
    {
        return $this->alreadyRegisteredUseCase;
    }

    /**
     *
     * @return UseCaseInterface
     */
    public function getDuplicatedUseCase()
    {
        return $this->duplicatedUseCase;
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
