<?php

namespace APL\Tests\Dispatcher;

use APL\Dispatcher\Dispatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    /** @var EventDispatcher */
    private $eventDispatcher;

    /** @var Command */
    private $command;

    public function setUp()
    {
        $this->eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->command = $this->getMock('APL\Command');
    }

    public function testExecuteWithNoUseCaseRegistered()
    {
        $this->setExpectedException('APL\Exception\UseCaseNotFoundException');

        $dispatcher = new Dispatcher($this->eventDispatcher);
        $dispatcher->execute($this->command);
    }
}
