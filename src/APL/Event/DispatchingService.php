<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

use APL\Command;
use APL\UseCase;
use APL\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DispatchingService
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
     * @param string $commandClass
     * @param UseCase $useCase
     */
    public function registerCommand($commandClass, UseCase $useCase)
    {
        $this->useCases[$commandClass] = $useCase;
    }

    /**
     * 
     * @param Command $command
     * @return Response
     * @throws \Exception
     */
    public function execute(Command $command)
    {
        try {
            $this->eventDispatcher->dispatch(
                Events::PRE_COMMAND,
                new PreCommandEvent($command)
            );

            $class = get_class($command);
            if (isset($this->useCases[$class])) {
                $response = $this->useCases[$class]->run($command);
            } else {
                throw new Exception\CommandNotFoundException();
            }

            $this->eventDispatcher->dispatch(
                Events::POST_COMMAND,
                new PostCommandEvent($command, $response)
            );

            return $response;
        } catch (\Exception $exception) {
            $event = new ExceptionEvent($command, $exception);
            $this->eventDispatcher->dispatch(Events::EXCEPTION, $event);

            if ($response = $event->getResponse()) {
                return $response;
            }

            throw $exception;
        }
    }
}
