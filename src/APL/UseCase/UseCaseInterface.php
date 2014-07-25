<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\UseCase;

use APL\Command\CommandInterface;
use APL\Response\ResponseInterface;

/**
 *
 */
interface UseCaseInterface
{
    /**
     * @param  CommandInterface $command
     * @return ResponseInterface
     */
    public function run(CommandInterface $command);
}
