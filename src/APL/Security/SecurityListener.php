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
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * 
 */
class SecurityListener
{
    /** @var SecurityContextInterface */
    protected $context;

    /** @var Policy[] */
    protected $polices = array();

    /**
     * 
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $context
     */
    public function __construct(SecurityContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * 
     * @param \APL\Policy\Policy $policy
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
            $policy->check($this->context, $event->getCommand());
        }
    }
}
