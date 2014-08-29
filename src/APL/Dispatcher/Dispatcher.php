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

    /** @var CommandStack */
    private $commandStack;

    /**
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param CommandStack $commandStack
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, CommandStack $commandStack = null)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->commandStack    = $commandStack ?: new CommandStack();
    }

    /**
     *
     * @param string           $commandClass
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
    public function registerUseCaseCollection(UseCaseCollectionInterface $useCase)
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
        $this->commandStack->push($command);

        try {

            $command  = $this->preCommand($command);
            $response = $this->doExecute($command);
            $response = $this->postCommand($command, $response);

        } catch (\Exception $exception) {

            $response = $this->exception($command, $exception);

        }

        return $this->terminate($command, $response);
    }

    /**
     *
     * @param  CommandInterface  $command
     * @return ResponseInterface
     */
    protected function doExecute(CommandInterface $command)
    {
        $useCase  = $this->resolveUseCase($command);
        $response = $useCase->run($command);

        if (!$response instanceof ResponseInterface) {
            throw new Exception\InvalidResponseException($command, $response);
        }

        return $response;
    }

    /**
     *
     * @param  CommandInterface $command
     * @return CommandInterface
     */
    protected function preCommand(CommandInterface $command)
    {
        $event = new Event\PreCommandEvent($command);
        $this->eventDispatcher->dispatch(Event\Events::PRE_COMMAND, $event);

        return $event->getCommand();
    }

    /**
     *
     * @param  CommandInterface  $command
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    protected function postCommand(CommandInterface $command, ResponseInterface $response)
    {
        $event = new Event\PostCommandEvent($command, $response);
        $this->eventDispatcher->dispatch(Event\Events::POST_COMMAND, $event);

        return $event->getResponse();
    }

    /**
     *
     * @param  CommandInterface  $command
     * @param  \Exception        $exception
     * @return ResponseInterface
     */
    protected function exception(CommandInterface $command, \Exception $exception)
    {
        $event = new Event\ExceptionEvent($command, $exception);
        $this->eventDispatcher->dispatch(Event\Events::EXCEPTION, $event);

        if (!($response = $event->getResponse())) {
            throw $exception;
        }

        return $response;
    }

    /**
     *
     * @param  CommandInterface  $command
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    protected function terminate(CommandInterface $command, ResponseInterface $response)
    {
        $event = new Event\TerminateEvent($command, $response);
        $this->eventDispatcher->dispatch(Event\Events::TERMINATE, $event);

        $this->commandStack->pop();

        return $event->getResponse();
    }

    /**
     *
     * @param  CommandInterface                   $command
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
