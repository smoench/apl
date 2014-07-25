<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Dispatcher;

use APL\Event;
use APL\Exception;
use APL\Command\CommandInterface;
use APL\Response\ResponseInterface;
use APL\UseCase\UseCaseInterface;
use APL\UseCase\UseCaseCollectionInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 *
 * @author Simon Mönch
 * @author David Badura <d.a.badura@gmail.com>
 */
class Dispatcher implements DispatcherInterface
{
    /**
     *
     * @var $eventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     *
     * @var UseCaseInterface[]
     */
    private $useCases = array();

    /**
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     *
     * @param string $commandClass
     * @param UseCaseInterface $useCase
     */
    public function registerCommand($commandClass, UseCaseInterface $useCase)
    {
        if (isset($this->useCases[$commandClass])) {
            throw new Exception\DuplicateUseCaseException($this->useCases[$commandClass], $useCase, $commandClass);
        }

        $this->useCases[$commandClass] = $useCase;
    }

    /**
     *
     * @param UseCaseCollectionInterface $useCase
     */
    public function registerUseCase(UseCaseCollectionInterface $useCase)
    {
        foreach (array_keys($useCase->register()) as $class) {
            $this->registerCommand($class, $useCase);
        }
    }

    /**
     *
     * @param  CommandInterface  $command
     * @return ResponseInterface
     * @throws \Exception
     */
    public function execute(CommandInterface $command)
    {
        try {
            $event = new Event\PreCommandEvent($command);
            $this->eventDispatcher->dispatch(Event\Events::PRE_COMMAND, $event);

            $command  = $event->getCommand();
            $useCase  = $this->resolveUseCase($command);
            $response = $useCase->run($command);

            if (!$response instanceof ResponseInterface) {
                throw new Exception\InvalidResponseException($command, $response);
            }

            $event = new Event\PostCommandEvent($command, $response);
            $this->eventDispatcher->dispatch(Event\Events::POST_COMMAND, $event);
            $response = $event->getResponse();
        } catch (\Exception $exception) {
            $event = new Event\ExceptionEvent($command, $exception);
            $this->eventDispatcher->dispatch(Event\Events::EXCEPTION, $event);

            if (!($response = $event->getResponse())) {
                throw $exception;
            }
        }

        $event = new Event\TerminateEvent($response);
        $this->eventDispatcher->dispatch(Event\Events::TERMINATE, $event);

        return $event->getResponse();
    }

    /**
     *
     * @param  CommandInterface $command
     * @return UseCaseInterface
     * @throws Exception\UseCaseNotFoundException
     */
    protected function resolveUseCase(CommandInterface $command)
    {
        $class = get_class($command);

        if (!isset($this->useCases[$class])) {
            throw new Exception\UseCaseNotFoundException($command);
        }

        return $this->useCases[$class];
    }
}
