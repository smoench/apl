<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Event;

final class Events
{
    const PRE_COMMAND = "apl.event.pre_command";
    const POST_COMMAND = "apl.event.post_command";
    const EXCEPTION = "apl.event.exception";
    const TERMINATE = "apl.event.terminate";
}
