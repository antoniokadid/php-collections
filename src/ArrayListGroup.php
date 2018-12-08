<?php

namespace Collections;

/**
 * Class ArrayListGroup
 *
 * @package Collections
 */
class ArrayListGroup
{
    /** @var mixed */
    public $key;
    /** @var ArrayList */
    public $group;

    /**
     * ArrayListGroup constructor.
     *
     * @param mixed $key
     * @param ArrayList $group
     */
    public function __construct($key, ArrayList $group)
    {
        $this->key =  $key;
        $this->group = $group;
    }
}