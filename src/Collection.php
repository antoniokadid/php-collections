<?php

namespace Collections;

/**
 * Class Collection
 *
 * @package Collections
 */
class Collection implements \IteratorAggregate, \Serializable, \Countable, \JsonSerializable
{
    /** @var array */
    protected $source;

    /**
     * Collection constructor.
     *
     * @param array|null $source
     */
    protected function __construct(array $source)
    {
        $this->source = $source;
    }

    public function __destruct()
    {
        if (is_array($this->source))
            unset($this->source);
    }

    /**
     * Clears the contents of the collection.
     */
    public function clear(): void
    {
        unset($this->source);

        $this->source = [];
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->source);
    }

    /**
     * @return array
     */
    public function getArrayCopy(): array
    {
        return $this->source;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->source);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->source;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        $data = json_decode($serialized, TRUE);
        if ($data === FALSE)
            throw new \InvalidArgumentException('Unable to unserialize collection.');

        $this->source = $data;
    }
}
