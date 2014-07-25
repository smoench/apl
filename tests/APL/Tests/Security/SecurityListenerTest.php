<?php

namespace APL\Tests\Security;

use APL\Security\SecurityListener;
use APL\Event\PreCommandEvent;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
class SecurityListenerTest extends \PHPUnit_Framework_TestCase
{

    public function testAccess()
    {
        $listener = new SecurityListener();
        $listener->addPolicy($this->createFakePolicy(true));
        $listener->preCommand($this->createPreCommandEvent());
    }

    /**
     *
     * @expectedException \APL\Exception\SecurityException
     */
    public function testDenied()
    {
        $listener = new SecurityListener();
        $listener->addPolicy($this->createFakePolicy(false));
        $listener->preCommand($this->createPreCommandEvent());
    }

    /**
     *
     * @return PreCommandEvent
     */
    private function createPreCommandEvent()
    {
        return new PreCommandEvent($this->getMock('APL\Command\CommandInterface'));
    }

    /**
     *
     * @param bool $return
     * @return \APL\Security\Policy
     */
    private function createFakePolicy($return)
    {
        $policy = $this->getMock('APL\Security\PolicyInterface');
        $policy
            ->expects($this->once())
            ->method('check')
            ->will($this->returnValue($return));

        return $policy;
    }
}
