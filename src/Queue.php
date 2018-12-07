<?php

namespace Collections;

/**
 * Class Queue
 *
 * @package Collections
 */
class Queue extends Collection
{
    /**
     * Queue constructor.
     *
     * @param array $source
     */
    public function __construct(array $source = [])
    {
        parent::__construct(array_values($source));
    }

    /**
     * Adds an object to the end of the queue.
     *
     * @param mixed $object
     */
    public function enqueue($object)
    {
        array_push($this->source, $object);
    }

    /**
     * Removes and returns the object at the beginning of the queue.
     *
     * @return mixed
     */
    public function dequeue()
    {
        return array_shift($this->source);
    }

    /**
     * Returns the object at the beginning of the queue without removing it.
     *
     * @return mixed
     */
    public function peek()
    {
        return array_shift(array_slice($this->source, 0, 1));
    }
}