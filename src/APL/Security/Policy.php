<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Security;

use APL\Command;

/**
 *
 */
interface Policy
{
    /**
     *
     * @param  Command $command
     * @return mixed
     */
    public function check(Command $command);
}
