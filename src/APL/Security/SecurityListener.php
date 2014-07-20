<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Security;

use APL\Event\PreCommandEvent;

/**
 *
 */
class SecurityListener
{
    /**
     *
     * @var Policy[]
     */
    protected $polices = array();

    /**
     *
     * @param Policy $policy
     */
    public function addPolicy(Policy $policy)
    {
        $this->polices[] = $policy;
    }

    /**
     *
     * @param \APL\Event\PreCommandEvent $event
     */
    public function preCommand(PreCommandEvent $event)
    {
        foreach ($this->polices as $policy) {
            $policy->check($event->getCommand());
        }
    }
}
