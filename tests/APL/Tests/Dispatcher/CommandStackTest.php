<?php

namespace APL\Tests\Dispatcher;

use APL\Command;
use APL\Dispatcher\CommandStack;

class CommandStackTest extends \PHPUnit_Framework_TestCase
{

    public function testCommandStack()
    {
        $stack = new CommandStack();

        $command1 = $this->createCommand();
        $command2 = $this->createCommand();
        $command3 = $this->createCommand();

        $this->assertEquals(null, $stack->getCurrentCommand());
        $this->assertEquals(null, $stack->getMasterCommand());
        $this->assertEquals(null, $stack->getParentCommand());
        $this->assertEquals(null, $stack->pop());

        $stack->push($command1);

        $this->assertEquals($command1, $stack->getCurrentCommand());
        $this->assertEquals($command1, $stack->getMasterCommand());
        $this->assertEquals(null, $stack->getParentCommand());

        $stack->push($command2);

        $this->assertEquals($command2, $stack->getCurrentCommand());
        $this->assertEquals($command1, $stack->getMasterCommand());
        $this->assertEquals($command1, $stack->getParentCommand());

        $stack->push($command3);

        $this->assertEquals($command3, $stack->getCurrentCommand());
        $this->assertEquals($command1, $stack->getMasterCommand());
        $this->assertEquals($command2, $stack->getParentCommand());

        $this->assertEquals($command3, $stack->pop());
        $this->assertEquals($command2, $stack->getCurrentCommand());
        $this->assertEquals($command1, $stack->getMasterCommand());
        $this->assertEquals($command1, $stack->getParentCommand());

        $this->assertEquals($command2, $stack->pop());
        $this->assertEquals($command1, $stack->getCurrentCommand());
        $this->assertEquals($command1, $stack->getMasterCommand());
        $this->assertEquals(null, $stack->getParentCommand());

        $this->assertEquals($command1, $stack->pop());
        $this->assertEquals(null, $stack->getCurrentCommand());
        $this->assertEquals(null, $stack->getMasterCommand());
        $this->assertEquals(null, $stack->getParentCommand());

        $this->assertEquals(null, $stack->pop());
        $this->assertEquals(null, $stack->getCurrentCommand());
        $this->assertEquals(null, $stack->getMasterCommand());
        $this->assertEquals(null, $stack->getParentCommand());
    }

    /**
     *
     * @return Command
     */
    protected function createCommand()
    {
        return $this->getMock('APL\Command');
    }
}
