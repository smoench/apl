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
use APL\Response;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
interface DispatcherInterface
{

    /**
     *
     * @param  Command  $command
     * @return Response
     */
    public function execute(Command $command);
}
