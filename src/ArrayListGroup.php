<?php

namespace AntonioKadid\Collections;

/**
 * Class ArrayListGroup
 *
 * @package AntonioKadid\Collections
 */
class ArrayListGroup
{
    /**
     * ArrayListGroup constructor.
     *
     * @param mixed     $key
     * @param ArrayList $group
     */
    public function __construct($key, ArrayList $group)
    {
        $this->key = $key;
        $this->group = $group;
    }

    /** @var mixed */
    public $key;
    /** @var ArrayList */
    public $group;
}