<?php

namespace APL;

use APL\Exception\MethodNotFoundException;
use APL\Command\CommandInterface;

/**
 *
 * @author David Badura <d.a.badura@gmail.com>
 */
abstract class AbstractUseCaseCollection implements UseCaseCollectionInterface
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
     * @return APL\Response\ResponseInterface
     */
    public function run(CommandInterface $command)
    {
        $mapping = $this->register();
        $method  = $mapping[get_class($command)];

        if (!method_exists($this, $method)) {
            throw new MethodNotFoundException($command, $this, $method);
        }

        return $this->$method($command);
    }
}
