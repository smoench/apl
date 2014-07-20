<?php

namespace APL\Tests\Dispatcher;

use APL\Command;
use APL\Dispatcher\Dispatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    /** @var EventDispatcher|\PHPUnit_Framework_MockObject_MockObject */
    private $eventDispatcher;

    /** @var Command|\PHPUnit_Framework_MockObject_MockObject */
    private $command;

    public function setUp()
    {
        $this->eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->command         = $this->getMock('APL\Command');
    }

    public function testExecuteWithNoUseCaseRegistered()
    {
        $this->setExpectedException('APL\Exception\UseCaseNotFoundException');

        $dispatcher = new Dispatcher($this->eventDispatcher);
        $dispatcher->execute($this->command);
    }
}
