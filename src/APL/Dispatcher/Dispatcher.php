<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Dispatcher;

use APL\Command;
use APL\Event;
use APL\Exception;
use APL\Response;
use APL\UseCase;
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

    /** @var UseCase[] */
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
     * @param string  $commandClass
     * @param UseCase $useCase
     */
    public function registerCommand($commandClass, UseCase $useCase)
    {
        $this->useCases[$commandClass] = $useCase;
    }

    /**
     *
     * @param  Command $command
     * @return Response
     * @throws \Exception
     */
    public function execute(Command $command)
    {
        try {
            $event = new Event\PreCommandEvent($command);
            $this->eventDispatcher->dispatch(Event\Events::PRE_COMMAND, $event);

            $command  = $event->getCommand();
            $useCase  = $this->resolveUseCase($command);
            $response = $useCase->run($command);

            if (!$response instanceof Response) {
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

        return $event->getResponse();
    }

    /**
     *
     * @param  Command $command
     * @throws \APL\Exception\UseCaseNotFoundException
     * @return UseCase
     */
    protected function resolveUseCase(Command $command)
    {
        $class = get_class($command);

        if (!isset($this->useCases[$class])) {
            throw new Exception\UseCaseNotFoundException($command);
        }

        return $this->useCases[$class];
    }
}
