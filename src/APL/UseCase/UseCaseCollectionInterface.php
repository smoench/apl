<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\UseCase;

/**
 *
 */
interface UseCaseCollectionInterface extends UseCaseInterface
{
    /**
     *
     * @return array
     */
    public function register();
}
