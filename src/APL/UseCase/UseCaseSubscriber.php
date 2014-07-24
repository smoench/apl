<?php

namespace APL;

use APL\Exception\MethodNotFoundException;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
abstract class UseCaseSubscriber
{

    /**
     *
     * Example:
     *
     * return [
     *  'APL\Example\EditCommand' => 'edit',
     *  'APL\Example\AddCommand'  => 'add'
     * ];
     *
     *
     * @return array
     */
    abstract public function register();

    /**
     *
     * @param Command $command
     * @return Response
     */
    public function run(Command $command)
    {
        $mapping = $this->register();
        $method  = $mapping[get_class($command)];

        if (!method_exists($this, $method)) {
            throw new MethodNotFoundException($command, $this, $method);
        }

        return $this->$method($command);
    }
}
