<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Dispatcher;

use APL\Command\CommandInterface;
use APL\Response\ResponseInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
interface DispatcherInterface
{

    /**
     *
     * @param  CommandInterface  $command
     * @return ResponseInterface
     */
    public function execute(CommandInterface $command);
}
