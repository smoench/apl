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
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 *
 * @author Simon Mönch
 * @author David Badura <d.a.badura@gmail.com>
 */
class Dispatcher implements DispatcherInterface
{
    /** @var $eventDispatcher */
    private $eventDispatcher;

    /** @var UseCaseInterface[] */
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
     * @param string $commandClass
     * @param UseCaseInterface $useCase
     */
    public function registerCommand($commandClass, UseCaseInterface $useCase)
    {
        $this->useCases[$commandClass] = $useCase;
    }

    /**
     *
     * @param  CommandInterface $command
     * @return ResponseInterface
     * @throws \Exception
     */
    public function execute(CommandInterface $command)
    {
        $this->commandStack->push($command);

        try {
            $event = new Event\PreCommandEvent($command);
            $this->eventDispatcher->dispatch(Event\Events::PRE_COMMAND, $event);

            $command  = $event->getCommand();
            $useCase  = $this->resolveUseCase($command);
            $response = $useCase->run($command);

            if (!$response instanceof ResponseInterface) {
                throw new Exception\Exception(); // todo add message!
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

        $this->commandStack->pop();

        return $event->getResponse();
    }

    /**
     *
     * @param  CommandInterface $command
     * @throws Exception\UseCaseNotFoundException
     * @return UseCaseInterface
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
