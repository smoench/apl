<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Security;

use APL\Command\CommandInterface;

/**
 *
 */
interface PolicyInterface
{
    /**
     *
     * @param  CommandInterface $command
     * @return bool
     */
    public function check(CommandInterface $command);
}
